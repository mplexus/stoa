<?php

require_once __DIR__ . '/../src/bootstrap.php';

use Stoa\Core\Router;
use Stoa\Core\Dispatcher;
use Stoa\Controller\IndexController;
use Symfony\Component\HttpFoundation\Request;

//$controller = new IndexController();
//$controller->invoke();

$router = new Router();
$router->get('foo', function() { echo "GET foo\n"; });
$router->post('bar', function() { echo "POST bar\n"; });

//$dispatcher = new Dispatcher($router);
//$request = Request::createFromGlobals();
//$dispatcher->handle($request);

Dispatcher::dispatch();
