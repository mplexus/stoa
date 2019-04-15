<?php

require_once __DIR__ . '/../src/bootstrap.php';

use Stoa\Core\Router;
use Stoa\Core\Dispatcher;
use Stoa\Core\Application;

$app = new Application($bootstrap);
$router = new Router($app);
//$dispatcher = new Dispatcher($app, $router);
//$dispatcher->dispatch();
