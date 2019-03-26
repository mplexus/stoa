<?php

use Dotenv\Dotenv;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use Twig\Environment as TwigEnvironment;

require_once __DIR__ . "/../vendor/autoload.php";

$bootstrap = array();

$bootstrap['name'] = 'Stoa';

$appPath = __DIR__ . '/../';

if (false == $env = getenv('app_env')) {
    $dotenv = new Dotenv($appPath);
    $dotenv->load();
    $env = getenv('app_env');
}
$bootstrap['env'] = $env;
if ($env == 'development') {
    error_reporting(E_ALL);
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
$bootstrap['connection'] = $conn;

$isDevMode = getenv('app_debug');
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/Model"), $isDevMode);
$bootstrap['config'] = $config;

$entityManager = EntityManager::create($conn, $config);
$bootstrap['entity_manager'] = $entityManager;

$loader = new TwigFilesystemLoader(__DIR__ . '/Templates');
$bootstrap['twig'] = new TwigEnvironment($loader, [
    'cacde' => __DIR__ . '../var/cache'
]);

$whoops = new \Whoops\Run;
if ($env !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();
