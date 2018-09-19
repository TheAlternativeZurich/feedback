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
use App\Form\FrontendUser\UpdateSelfType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/account")
 */
class AccountController extends BaseUserController
{
    /**
     * @Route("", name="account")
     *
     * @param Request $request
     * @param TranslatorInterface $translator
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, TranslatorInterface $translator)
    {
        $arr = [];

        $user = $this->getUser();
        $oldEmail = $user->getEmail();
        $arr['user'] = $user;

        //change password form
        $form = $this->handleForm(
            $this->createForm(ChangePasswordType::class, $user)
                ->add('form.change_password', SubmitType::class, ['translation_domain' => 'account', 'label' => 'index.change_password']),
            $request,
            function ($form) use ($user) {
                if ($this->setNewPasswordIfValid($user)) {
                    $this->fastSave($user);
                    $this->displaySuccess($this->getTranslator()->trans('index.success.password_changed', [], 'account'));
                }

                return $form;
            }
        );
        $arr['change_password_form'] = $form->createView();

        //edit account form
        $form = $this->handleForm(
            $this->createForm(UpdateSelfType::class, $user)
                ->add('form.save', SubmitType::class, ['translation_domain' => 'framework', 'label' => 'form.submit_buttons.update']),
            $request,
            function ($form) use ($request, $user, $translator, $oldEmail) {
                //if email changed, ensure it is not taken already
                if ($user->getEmail() !== $oldEmail) {
                    $exitingUser = $this->getDoctrine()->getRepository(FrontendUser::class)->findOneBy(['email' => $user->getEmail()]);
                    if (null !== $exitingUser) {
                        $this->displayError($translator->trans('index.error.email_taken', [], 'account'));

                        return $form;
                    }
                }

                $this->fastSave($user);
                $this->displaySuccess($translator->trans('form.successful.updated', [], 'framework'));

                if ($user->getEmail() !== $oldEmail) {
                    $this->loginUser($request, $user);
                }

                return $form;
            }
        );
        $arr['update_form'] = $form->createView();

        return $this->render('account/index.html.twig', $arr);
    }
}
