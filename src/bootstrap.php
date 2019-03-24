<?php

use Dotenv\Dotenv;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . "/../vendor/autoload.php";

$appPath = __DIR__ . '/../';

if (false == $env = getenv('app_env')) {
    $dotenv = new Dotenv($appPath);
    $dotenv->load();
    $env = getenv('app_env');
}

// database configuration parameters
$conn = array(
    'driver' => getenv($env . '_database_driver'),
    'user' => getenv($env . '_database_user'),
    'password' => getenv($env . '_database_password'),
    'dbname' => getenv($env . '_database_name'),
    'host' => getenv($env . '_database_host'),
    'port' => getenv($env . '_database_port'),
    'charset' => 'utf8',
    'driverOptions' => array(
        1002 => 'SET NAMES utf8'
    )
);

$isDevMode = getenv('app_debug');
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Model"), $isDevMode);

// obtaining the entity manager
//$entityManager = EntityManager::create($conn, $config);
