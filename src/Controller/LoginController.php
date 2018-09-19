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

use App\Controller\Base\BaseFormController;
use App\Form\Event\LoginType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/login")
 */
class LoginController extends BaseFormController
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
