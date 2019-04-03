<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Stoa\Controller\IndexController;
use Stoa\Controller\OrderController;
use Stoa\Controller\CustomerController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Router
{

    /**
     * @var RouteCollection
     */
    private $routes = null;

    public function __construct()
    {
        if ($this->routes == null) {
            $this->routes = new RouteCollection();

            $this->setRoutes();
        }
    }

    private function setRoutes() : void
    {
        $this->routes->add('stats', new Route('/stats', [
            '_controller' => [IndexController::class, 'statsAction']
        ]));

        $this->routes->add('orders', new Route('/orders', [
            '_controller' => [OrderController::class, 'listAction']
        ]));

        $this->routes->add('order', new Route('/orders/{id}', [
            '_controller' => [OrderController::class, 'viewAction']
        ]));

        $this->routes->add('customers', new Route('/customers', [
            '_controller' => [CustomerController::class, 'listAction']
        ]));

        $this->routes->add('index', new Route('/', [
            '_controller' => [IndexController::class, 'indexAction']
        ]));
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes() : RouteCollection
    {
        return $this->routes;
    }
}
