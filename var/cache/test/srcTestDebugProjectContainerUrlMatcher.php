<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcTestDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = $allowSchemes = array();
        if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
            return $ret;
        }
        if ($allow) {
            throw new MethodNotAllowedException(array_keys($allow));
        }
        if (!in_array($this->context->getMethod(), array('HEAD', 'GET'), true)) {
            // no-op
        } elseif ($allowSchemes) {
            redirect_scheme:
            $scheme = $this->context->getScheme();
            $this->context->setScheme(key($allowSchemes));
            try {
                if ($ret = $this->doMatch($pathinfo)) {
                    return $this->redirect($pathinfo, $ret['_route'], $this->context->getScheme()) + $ret;
                }
            } finally {
                $this->context->setScheme($scheme);
            }
        } elseif ('/' !== $pathinfo) {
            $pathinfo = '/' !== $pathinfo[-1] ? $pathinfo.'/' : substr($pathinfo, 0, -1);
            if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
                return $this->redirect($pathinfo, $ret['_route']) + $ret;
            }
            if ($allowSchemes) {
                goto redirect_scheme;
            }
        }

        throw new ResourceNotFoundException();
    }

    private function doMatch(string $rawPathinfo, array &$allow = array(), array &$allowSchemes = array()): ?array
    {
        $allow = $allowSchemes = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $context = $this->context;
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        switch ($pathinfo) {
            default:
                $routes = array(
                    '/account' => array(array('_route' => 'account', '_controller' => 'App\\Controller\\AccountController::indexAction'), null, null, null),
                    '/administration' => array(array('_route' => 'administration', '_controller' => 'App\\Controller\\AdministrationController::indexAction'), null, null, null),
                    '/contact' => array(array('_route' => 'contact', '_controller' => 'App\\Controller\\ContactController::indexAction'), null, null, null),
                    '/' => array(array('_route' => 'index', '_controller' => 'App\\Controller\\IndexController::indexAction'), null, null, null),
                    '/login' => array(array('_route' => 'login', '_controller' => 'App\\Controller\\LoginController::indexAction'), null, null, null),
                    '/login/recover' => array(array('_route' => 'login_recover', '_controller' => 'App\\Controller\\LoginController::recoverAction'), null, null, null),
                    '/login/login_check' => array(array('_route' => 'login_check', '_controller' => 'App\\Controller\\LoginController::loginCheck'), null, null, null),
                    '/login/logout' => array(array('_route' => 'login_logout', '_controller' => 'App\\Controller\\LoginController::logoutAction'), null, null, null),
                    '/register' => array(array('_route' => 'register', '_controller' => 'App\\Controller\\RegisterController::registerAction'), null, null, null),
                    '/administration/frontend_users' => array(array('_route' => 'administration_frontend_users', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::indexAction'), null, null, null),
                    '/administration/frontend_users/create' => array(array('_route' => 'administration_frontend_user_create', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::createAction'), null, null, null),
                    '/administration/settings' => array(array('_route' => 'administration_settings', '_controller' => 'App\\Controller\\Administration\\SettingsController::indexAction'), null, null, null),
                    '/api/vote/frontend_users' => array(array('_route' => 'api_vote_frontend_users', '_controller' => 'App\\Controller\\Api\\VoteController::dataAction'), null, null, null),
                );

                if (!isset($routes[$pathinfo])) {
                    break;
                }
                list($ret, $requiredHost, $requiredMethods, $requiredSchemes) = $routes[$pathinfo];

                $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                    if ($hasRequiredScheme) {
                        $allow += $requiredMethods;
                    }
                    break;
                }
                if (!$hasRequiredScheme) {
                    $allowSchemes += $requiredSchemes;
                    break;
                }

                return $ret;
        }

        $matchedPathinfo = $pathinfo;
        $regexList = array(
            0 => '{^(?'
                    .'|/email/([^/]++)(*:22)'
                    .'|/login/reset/([^/]++)(*:50)'
                    .'|/administration/frontend_users/([^/]++)/(?'
                        .'|update(*:106)'
                        .'|delete(*:120)'
                        .'|toggle_can_login(*:144)'
                    .')'
                .')$}sD',
        );

        foreach ($regexList as $offset => $regex) {
            while (preg_match($regex, $matchedPathinfo, $matches)) {
                switch ($m = (int) $matches['MARK']) {
                    default:
                        $routes = array(
                            22 => array(array('_route' => 'email_view', '_controller' => 'App\\Controller\\EmailController::viewAction'), array('identifier'), null, null),
                            50 => array(array('_route' => 'login_reset', '_controller' => 'App\\Controller\\LoginController::resetAction'), array('resetHash'), null, null),
                            106 => array(array('_route' => 'administration_frontend_user_update', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::updateAction'), array('frontendUser'), null, null),
                            120 => array(array('_route' => 'administration_frontend_user_delete', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::deleteAction'), array('frontendUser'), null, null),
                            144 => array(array('_route' => 'administration_frontend_user_toggle_can_login', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::toggleLoginEnabled'), array('frontendUser'), null, null),
                        );

                        list($ret, $vars, $requiredMethods, $requiredSchemes) = $routes[$m];

                        foreach ($vars as $i => $v) {
                            if (isset($matches[1 + $i])) {
                                $ret[$v] = $matches[1 + $i];
                            }
                        }

                        $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                        if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                            if ($hasRequiredScheme) {
                                $allow += $requiredMethods;
                            }
                            break;
                        }
                        if (!$hasRequiredScheme) {
                            $allowSchemes += $requiredSchemes;
                            break;
                        }

                        return $ret;
                }

                if (144 === $m) {
                    break;
                }
                $regex = substr_replace($regex, 'F', $m - $offset, 1 + strlen($m));
                $offset += strlen($m);
            }
        }
        if ('/' === $pathinfo && !$allow && !$allowSchemes) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        return null;
    }
}
