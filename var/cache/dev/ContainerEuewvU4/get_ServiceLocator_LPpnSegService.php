<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.LPpnSeg' shared service.

return $this->privates['.service_locator.LPpnSeg'] = new \Symfony\Component\DependencyInjection\ServiceLocator(array('emailService' => function () {
    return ($this->privates['App\Service\EmailService'] ?? $this->load('getEmailServiceService.php'));
}, 'translator' => function () {
    return ($this->services['translator'] ?? $this->getTranslatorService());
}));
