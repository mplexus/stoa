<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Stoa\Core\Application;
use Symfony\Component\Routing\Route;
use Stoa\Controller\IndexController;
use Stoa\Controller\OrderController;
use Stoa\Controller\CustomerController;
use Symfony\Component\Routing\RouteCollection;
use Stoa\Core\Exception\ApplicationException;
use Symfony\Component\HttpFoundation\Request;

class Router
{

    /**
     * @var RouteCollection
     */
    private $routes = null;

    /**
     * @var Application
     */
    private $app = null;

    public function __construct(Application $app)
    {
        if ($this->routes == null) {
            $this->routes = [];//RouteCollection();

            //$this->setRoutes();
        }

        $this->app = $app;

        $url = $_SERVER['REQUEST_URI'];
        $urlArray = array();
        $urlArray = explode("/",$url);

        $request = $_SERVER['REQUEST_URI'];
        $parsed = explode('?' , $request);

        //find controller/action
        $uri = array_shift($parsed);
        $uriParts = explode('/', $uri);
        $route = $uriParts[1];
        $id = $uriParts[2] ?? null;

        //find params
        //$getVars = array();
        //foreach ($parsed as $argument)
        //{
            //list($variable , $value) = split('=' , $argument);
            //$getVars[$variable] = $value;
        //}

        //$vars = print_r($getVars, TRUE);

        $this->validate($route, $id, []);
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
        $controller = null;
        $controllerName = $this->resolveControllerName($route);
        $target = APPLICATION_ROOT .  DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $controllerName . 'Controller.php';
        if (file_exists($target)) {
            include_once($target);
            $class = "Stoa\\Controller\\" . $controllerName . "Controller";
            $controller = new $class($this->app);
        } else {
            throw ApplicationException::badRequest($route);
        }

        $action = null;
        switch (1) {
            case $route == "orders" && $id != null:
                $action = "viewAction";
                break;
            case $route == "orders":
            case $route == "customers":
                $action = "listAction";
                break;
            case $route == "stats":
                $action = "statsAction";
                break;
            default:
                $action = "indexAction";
                break;
        }

        if ((int)method_exists($controller, $action)) {
            $request = Request::createFromGlobals();
            $response = call_user_func_array(array($controller,$action),array($request, $id));
            $response->send();
        } else {
            throw ApplicationException::badRequest($route);
        }
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes() : RouteCollection
    {
        return $this->routes;
    }

    public function resolveControllerName($route) : string
    {
        $controllerName = ucfirst(rtrim($route, 's'));
        if ($route == "stats") {
            $controllerName = "Index";
        }
        return $controllerName;
    }
}
