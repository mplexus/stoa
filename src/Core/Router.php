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
            $this->routes = new array();//RouteCollection();

            //$this->setRoutes();
        }

        $url = $_SERVER['REQUEST_URI'];
        $urlArray = array();
        $urlArray = explode("/",$url);

        $request = $_SERVER['REQUEST_URI'];
        $parsed = explode('?' , $request);

        //find controller/action
        $uri = array_shift($parsed);
        $uriParts = explode('/', $uri);
        $route = $uriParts[1];
        echo "route=".$route."<br/>";
        $id = $uriParts[2] ?? null;
        echo "id=".$id."<br/>";

        //find params
        $getVars = array();
        foreach ($parsed as $argument)
        {
            list($variable , $value) = split('=' , $argument);
            $getVars[$variable] = $value;
        }

        $vars = print_r($getVars, TRUE);
        print "The following GET vars were passed to the page:<pre>".$vars."</pre>";

        $this->validate($route, $id, $getVars);
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
     * @param string $route
     * @param int $id
     * @param array $params
     */
    public function validate ($route, $id, $params) : void
    {
        $controllerName = $route;

        switch (1) {
            case $route == "orders":
                $controllerName = ;
                break;
            default:
                break;
        }

        $controller = ucwords($controller);
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes() : RouteCollection
    {
        return $this->routes;
    }
}
