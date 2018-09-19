<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Controller\Administration\FrontendUserController' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/ControllerTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
include_once $this->targetDirs[3].'/src/Controller/Base/BaseController.php';
include_once $this->targetDirs[3].'/src/Controller/Base/BaseDoctrineController.php';
include_once $this->targetDirs[3].'/src/Controller/Base/BaseFormController.php';
include_once $this->targetDirs[3].'/src/Controller/Administration/Base/BaseController.php';
include_once $this->targetDirs[3].'/src/Controller/Administration/FrontendUserController.php';

$this->services['App\Controller\Administration\FrontendUserController'] = $instance = new \App\Controller\Administration\FrontendUserController();

$instance->setContainer(($this->privates['.service_locator.gok9enq'] ?? $this->load('get_ServiceLocator_Gok9enqService.php'))->withContext('App\\Controller\\Administration\\FrontendUserController', $this));

return $instance;
