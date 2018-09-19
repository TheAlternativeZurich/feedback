<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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
                    '/_profiler/' => array(array('_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'), null, null, null),
                    '/_profiler/search' => array(array('_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'), null, null, null),
                    '/_profiler/search_bar' => array(array('_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'), null, null, null),
                    '/_profiler/phpinfo' => array(array('_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'), null, null, null),
                    '/_profiler/open' => array(array('_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'), null, null, null),
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
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                        .'|wdt/([^/]++)(*:57)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:102)'
                                .'|router(*:116)'
                                .'|exception(?'
                                    .'|(*:136)'
                                    .'|\\.css(*:149)'
                                .')'
                            .')'
                            .'|(*:159)'
                        .')'
                    .')'
                    .'|/email/([^/]++)(*:184)'
                    .'|/login/reset/([^/]++)(*:213)'
                    .'|/administration/frontend_users/([^/]++)/(?'
                        .'|update(*:270)'
                        .'|delete(*:284)'
                        .'|toggle_can_login(*:308)'
                    .')'
                .')$}sD',
        );

        foreach ($regexList as $offset => $regex) {
            while (preg_match($regex, $matchedPathinfo, $matches)) {
                switch ($m = (int) $matches['MARK']) {
                    default:
                        $routes = array(
                            38 => array(array('_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code', '_format'), null, null),
                            57 => array(array('_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'), array('token'), null, null),
                            102 => array(array('_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'), array('token'), null, null),
                            116 => array(array('_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'), array('token'), null, null),
                            136 => array(array('_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'), array('token'), null, null),
                            149 => array(array('_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'), array('token'), null, null),
                            159 => array(array('_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'), array('token'), null, null),
                            184 => array(array('_route' => 'email_view', '_controller' => 'App\\Controller\\EmailController::viewAction'), array('identifier'), null, null),
                            213 => array(array('_route' => 'login_reset', '_controller' => 'App\\Controller\\LoginController::resetAction'), array('resetHash'), null, null),
                            270 => array(array('_route' => 'administration_frontend_user_update', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::updateAction'), array('frontendUser'), null, null),
                            284 => array(array('_route' => 'administration_frontend_user_delete', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::deleteAction'), array('frontendUser'), null, null),
                            308 => array(array('_route' => 'administration_frontend_user_toggle_can_login', '_controller' => 'App\\Controller\\Administration\\FrontendUserController::toggleLoginEnabled'), array('frontendUser'), null, null),
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

                if (308 === $m) {
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
