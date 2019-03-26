<?php

require_once __DIR__ . '/../src/bootstrap.php';

use Stoa\Core\Router;
use Stoa\Core\Dispatcher;

//$app = new Application($bootstrap);
$router = new Router();
$dispatcher = new Dispatcher($router);
$dispatcher->dispatch();
