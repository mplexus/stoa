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
        $this->routes->add('index_list', new Route('/stats', [
            '_controller' => [IndexController::class, 'listAction']
        ]));
    }

    public function getRoutes() {
        return $this->routes;
    }
}
