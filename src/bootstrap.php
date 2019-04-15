<?php

use Dotenv\Dotenv;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use \Whoops\Handler\PrettyPageHandler;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use Twig\Environment as TwigEnvironment;

require_once __DIR__ . "/../vendor/autoload.php";

define('APPLICATION_ROOT' , __DIR__);

$bootstrap = array();

$bootstrap['name'] = 'Stoa';

$appPath = __DIR__ . '/../';

if (false == $env = getenv('app_env')) {
    $dotenv = new Dotenv($appPath);
    $dotenv->load();
    $env = getenv('app_env');
}
$bootstrap['env'] = $env;

$isDevMode = false;
if ($env == 'development') {
    error_reporting(E_ALL);
    $disableCache = true;
    $isDevMode = true;
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

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/Model"), $isDevMode);
$config->addCustomDatetimeFunction('DATE_FORMAT', \Stoa\Query\DateFormat::class);
$bootstrap['config'] = $config;

$entityManager = EntityManager::create($conn, $config);
$bootstrap['entity_manager'] = $entityManager;

$loader = new TwigFilesystemLoader(__DIR__ . '/Templates');
$bootstrap['twig'] = new TwigEnvironment($loader, [
    'cache' => (isset($disableCache) ? false : __DIR__ . '/../var/cache')
]);

$whoops = new \Whoops\Run;
if ($env !== 'production') {
    $whoops->pushHandler(new PrettyPageHandler());
} else {
    $whoops->pushHandler(function($e){
        echo 'Oops! Something went wrong. Please contact site administrator.';
    });
}
$whoops->register();
