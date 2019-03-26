<?php

namespace Stoa\Core;

use Stoa\Controller\IndexController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Router
{

    private $routes = null;

    public function __construct() {
        if ($this->routes == null) {
            $this->routes = new RouteCollection();

            $this->setRoutes();
        }
    }

    private function setRoutes() {
        $this->routes->add('stats', new Route('/stats', [
            '_controller' => [IndexController::class, 'statsAction']
        ]));

        $this->routes->add('index', new Route('/', [
            '_controller' => [IndexController::class, 'indexAction']
        ]));
    }

    public function getRoutes() {
        return $this->routes;
    }
}
