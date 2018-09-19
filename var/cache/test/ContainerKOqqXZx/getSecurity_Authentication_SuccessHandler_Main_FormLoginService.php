<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.authentication.success_handler.main.form_login' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Authentication/AuthenticationSuccessHandlerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Util/TargetPathTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Authentication/DefaultAuthenticationSuccessHandler.php';

$this->privates['security.authentication.success_handler.main.form_login'] = $instance = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler(($this->privates['security.http_utils'] ?? $this->load('getSecurity_HttpUtilsService.php')), array());

$instance->setOptions(array('login_path' => 'login', 'default_target_path' => 'index', 'always_use_default_target_path' => false, 'target_path_parameter' => '_target_path', 'use_referer' => false));
$instance->setProviderKey('main');

return $instance;
