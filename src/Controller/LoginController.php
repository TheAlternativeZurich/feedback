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
use App\Form\PasswordContainer\LoginType;
use App\Model\PasswordContainer;
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
     * @return Response
     */
    public function indexAction(AuthenticationUtils $authenticationUtils)
    {
        //check if auth failed last try
        if ($errorOccurred = (null !== $authenticationUtils->getLastAuthenticationError(true))) {
            $this->displayError($this->getTranslator()->trans('login.error.login_failed', [], 'login'));
        }

        // create login form
        $form = $this->createForm(LoginType::class, new PasswordContainer(''));
        $form->add('form.login', SubmitType::class, ['translation_domain' => 'login', 'label' => 'login.do_login']);

        return $this->render('login/login.html.twig', ['form' => $form->createView(), 'error_occurred' => $errorOccurred]);
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
