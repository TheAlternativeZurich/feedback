<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'doctrine.dbal.default_connection' shared service.

include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Driver/Connection.php';
include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Connection.php';
include_once $this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/ConnectionFactory.php';

return $this->services['doctrine.dbal.default_connection'] = ($this->privates['doctrine.dbal.connection_factory'] ?? $this->privates['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array()))->createConnection(array('driver' => 'pdo_sqlite', 'url' => $this->getEnv('resolve:DATABASE_URL'), 'host' => 'localhost', 'port' => NULL, 'user' => 'root', 'password' => NULL, 'driverOptions' => array(), 'defaultTableOptions' => array()), ($this->privates['doctrine.dbal.default_connection.configuration'] ?? $this->load('getDoctrine_Dbal_DefaultConnection_ConfigurationService.php')), ($this->privates['doctrine.dbal.default_connection.event_manager'] ?? $this->load('getDoctrine_Dbal_DefaultConnection_EventManagerService.php')), array());
