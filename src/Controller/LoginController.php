<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Controller\Base\BaseUserController;
use App\Entity\FrontendUser;
use App\Form\FrontendUser\ChangePasswordType;
use App\Form\FrontendUser\LoginType;
use App\Form\FrontendUser\RecoverType;
use App\Model\Breadcrumb;
use App\Service\Interfaces\EmailServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/login")
 */
class LoginController extends BaseUserController
{
    /**
     * @Route("", name="login")
     *
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function indexAction(AuthenticationUtils $authenticationUtils)
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        if (null !== $authenticationUtils->getLastAuthenticationError(true)) {
            $lastUser = $this->getDoctrine()->getRepository(FrontendUser::class)->findOneBy(['email' => $lastUsername]);
            if (null === $lastUser) {
                $this->displayError($this->getTranslator()->trans('login.error.email_not_found', [], 'login'));
            } elseif (!$lastUser->getCanLogin()) {
                $this->displayError($this->getTranslator()->trans('login.error.login_disabled', [], 'login'));
            } else {
                $this->displayError($this->getTranslator()->trans('login.error.login_failed', [], 'login'));
            }
        }

        $user = new FrontendUser();
        $user->setEmail($lastUsername);

        // create login form
        $form = $this->createForm(LoginType::class, $user);
        $form->add('form.login', SubmitType::class, ['translation_domain' => 'login', 'label' => 'login.do_login']);

        return $this->render('login/login.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/recover", name="login_recover")
     *
     * @param Request $request
     * @param EmailServiceInterface $emailService
     * @param TranslatorInterface $translator
     * @param LoggerInterface $logger
     *
     * @return Response
     */
    public function recoverAction(Request $request, EmailServiceInterface $emailService, TranslatorInterface $translator, LoggerInterface $logger)
    {
        $form = $this->handleForm(
            $this->createForm(RecoverType::class)
                ->add('form.recover', SubmitType::class, ['translation_domain' => 'login', 'label' => 'recover.title']),
            $request,
            function ($form) use ($emailService, $translator, $logger) {
                /* @var FormInterface $form */

                //display success
                $this->displaySuccess($translator->trans('recover.success.email_sent', [], 'login'));

                //check if user exists
                $exitingUser = $this->getDoctrine()->getRepository(FrontendUser::class)->findOneBy(['email' => $form->getData()['email']]);
                if (null === $exitingUser) {
                    $logger->warning('tried to reset password for non-existent email ' . $form->getData()['email']);

                    return $form;
                }

                //do not send password reset link if not enabled
                if (!$exitingUser->getCanLogin()) {
                    $logger->warning('tried to reset password for disabled account ' . $form->getData()['email']);

                    return $form;
                }

                //create new reset hash
                $exitingUser->setResetHash();
                $this->fastSave($exitingUser);

                //send recover email
                $emailService->sendActionEmail(
                    $exitingUser->getEmail(),
                    $translator->trans('recover.email.reset_password.subject', [], 'login'),
                    $translator->trans('recover.email.reset_password.message', [], 'login'),
                    $translator->trans('recover.email.reset_password.action_text', [], 'login'),
                    $this->generateUrl('login_reset', ['resetHash' => $exitingUser->getResetHash()], UrlGeneratorInterface::ABSOLUTE_URL)
                );
                $logger->warning('reset email sent to ' . $exitingUser->getEmail());

                return $form;
            }
        );

        return $this->render('login/recover.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/reset/{resetHash}", name="login_reset")
     *
     * @param Request $request
     * @param $resetHash
     * @param TranslatorInterface $translator
     *
     * @return Response
     */
    public function resetAction(Request $request, $resetHash, TranslatorInterface $translator)
    {
        $user = $this->getDoctrine()->getRepository(FrontendUser::class)->findOneBy(['resetHash' => $resetHash]);
        if (null === $user) {
            $this->displayError($translator->trans('reset.error.invalid_hash', [], 'login'));

            return new RedirectResponse($this->generateUrl('login'));
        }

        //ensure user can indeed login
        if (!$user->getCanLogin()) {
            $this->displayError($translator->trans('login.error.login_disabled', [], 'login'));

            return $this->redirectToRoute('login');
        }

        $form = $this->handleForm(
            $this->createForm(ChangePasswordType::class, $user, ['data_class' => FrontendUser::class])
                ->add('form.set_password', SubmitType::class, ['translation_domain' => 'login', 'label' => 'reset.title']),
            $request,
            function ($form) use ($user, $translator, $request) {
                //set valid password if possible
                if (!$this->setNewPasswordIfValid($user)) {
                    return $form;
                }

                //set new reset hash & display success message
                $user->setResetHash();
                $this->fastSave($user);
                $this->displaySuccess($translator->trans('reset.success.password_set', [], 'login'));

                //login user & redirect
                $this->loginUser($request, $user);

                return $this->redirectToRoute('index');
            }
        );

        if ($form instanceof Response) {
            return $form;
        }

        return $this->render('login/reset.html.twig', ['form' => $form->createView()]);
    }

    /**
     * get the breadcrumbs leading to this controller.
     *
     * @return Breadcrumb[]
     */
    protected function getIndexBreadcrumbs()
    {
        return [
            new Breadcrumb(
                $this->generateUrl('login'),
                $this->getTranslator()->trans('login.title', [], 'login')
            ),
        ];
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheck()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    /**
     * @Route("/logout", name="login_logout")
     */
    public function logoutAction()
    {
        throw new \RuntimeException('You must configure the logout path to be handled by the firewall using form_login.logout in your security firewall configuration.');
    }
}
