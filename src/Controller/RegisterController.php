<?php

/*
 * This file is part of the symfony-template project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Controller\Base\BaseUserController;
use App\Entity\FrontendUser;
use App\Form\FrontendUser\RegisterType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/register")
 */
class RegisterController extends BaseUserController
{
    /**
     * @Route("", name="register")
     *
     * @param Request $request
     * @param TranslatorInterface $translator
     *
     * @return Response
     */
    public function registerAction(Request $request, TranslatorInterface $translator)
    {
        $user = new FrontendUser();
        $form = $this->handleForm(
            $this->createForm(RegisterType::class, $user)
                ->add('form.register', SubmitType::class, ['translation_domain' => 'register', 'label' => 'index.title']),
            $request,
            function ($form) use ($request, $translator, $user) {
                /* @var FormInterface $form */

                //set valid password if possible
                if (!$this->setNewPasswordIfValid($user)) {
                    return $form;
                }

                //check if email already exists
                $exitingUser = $this->getDoctrine()->getRepository(FrontendUser::class)->findOneBy(['email' => $user->getEmail()]);
                if (null !== $exitingUser) {
                    $this->displayError($translator->trans('index.error.email_already_in_use', [], 'register'));

                    return $form;
                }

                //save user & show success message
                $this->fastSave($user);
                $this->displaySuccess($translator->trans('index.success.registered', [], 'register'));
                $this->loginUser($request, $user);

                //redirect to start page
                return $this->redirectToRoute('index');
            }
        );
        if ($form instanceof Response) {
            return $form;
        }

        return $this->render('register/register.html.twig', ['form' => $form->createView()]);
    }
}
