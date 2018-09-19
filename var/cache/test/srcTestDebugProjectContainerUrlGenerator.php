<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcTestDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'account' => array(array(), array('_controller' => 'App\\Controller\\AccountController::indexAction'), array(), array(array('text', '/account')), array(), array()),
        'administration' => array(array(), array('_controller' => 'App\\Controller\\AdministrationController::indexAction'), array(), array(array('text', '/administration')), array(), array()),
        'contact' => array(array(), array('_controller' => 'App\\Controller\\ContactController::indexAction'), array(), array(array('text', '/contact')), array(), array()),
        'email_view' => array(array('identifier'), array('_controller' => 'App\\Controller\\EmailController::viewAction'), array(), array(array('variable', '/', '[^/]++', 'identifier'), array('text', '/email')), array(), array()),
        'index' => array(array(), array('_controller' => 'App\\Controller\\IndexController::indexAction'), array(), array(array('text', '/')), array(), array()),
        'login' => array(array(), array('_controller' => 'App\\Controller\\LoginController::indexAction'), array(), array(array('text', '/login')), array(), array()),
        'login_recover' => array(array(), array('_controller' => 'App\\Controller\\LoginController::recoverAction'), array(), array(array('text', '/login/recover')), array(), array()),
        'login_reset' => array(array('resetHash'), array('_controller' => 'App\\Controller\\LoginController::resetAction'), array(), array(array('variable', '/', '[^/]++', 'resetHash'), array('text', '/login/reset')), array(), array()),
        'login_check' => array(array(), array('_controller' => 'App\\Controller\\LoginController::loginCheck'), array(), array(array('text', '/login/login_check')), array(), array()),
        'login_logout' => array(array(), array('_controller' => 'App\\Controller\\LoginController::logoutAction'), array(), array(array('text', '/login/logout')), array(), array()),
        'register' => array(array(), array('_controller' => 'App\\Controller\\RegisterController::registerAction'), array(), array(array('text', '/register')), array(), array()),
        'administration_frontend_users' => array(array(), array('_controller' => 'App\\Controller\\Administration\\FrontendUserController::indexAction'), array(), array(array('text', '/administration/frontend_users')), array(), array()),
        'administration_frontend_user_create' => array(array(), array('_controller' => 'App\\Controller\\Administration\\FrontendUserController::createAction'), array(), array(array('text', '/administration/frontend_users/create')), array(), array()),
        'administration_frontend_user_update' => array(array('frontendUser'), array('_controller' => 'App\\Controller\\Administration\\FrontendUserController::updateAction'), array(), array(array('text', '/update'), array('variable', '/', '[^/]++', 'frontendUser'), array('text', '/administration/frontend_users')), array(), array()),
        'administration_frontend_user_delete' => array(array('frontendUser'), array('_controller' => 'App\\Controller\\Administration\\FrontendUserController::deleteAction'), array(), array(array('text', '/delete'), array('variable', '/', '[^/]++', 'frontendUser'), array('text', '/administration/frontend_users')), array(), array()),
        'administration_frontend_user_toggle_can_login' => array(array('frontendUser'), array('_controller' => 'App\\Controller\\Administration\\FrontendUserController::toggleLoginEnabled'), array(), array(array('text', '/toggle_can_login'), array('variable', '/', '[^/]++', 'frontendUser'), array('text', '/administration/frontend_users')), array(), array()),
        'administration_settings' => array(array(), array('_controller' => 'App\\Controller\\Administration\\SettingsController::indexAction'), array(), array(array('text', '/administration/settings')), array(), array()),
        'api_vote_frontend_users' => array(array(), array('_controller' => 'App\\Controller\\Api\\VoteController::dataAction'), array(), array(array('text', '/api/vote/frontend_users')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
