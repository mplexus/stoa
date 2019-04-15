<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Stoa\Core\Router;
use Stoa\Core\Application;
use Stoa\Core\Exception\ApplicationException;
use Symfony\Component\HttpFoundation\Request;

class Dispatcher
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     * @param Router $router
     */
    function __construct(Application $app, Router $router)
    {
        $this->router = $router;
        $this->app = $app;
    }

    public function match() : void
    {
        $routes = $this->router->getRoutes();

        $request = $_SERVER['REQUEST_URI'];
        $parsed = explode('?' , $request);

        $uri = array_shift($parsed);
        $uriParts = explode('/', $uri);

        $id = $uriParts[2] ?? null;
        $requestedPath = $uriParts[1] .  ($id ? '/'.$id : '');

        foreach ($routes as $route) {
            $regex = "#^".$route[0]."$#";

            if (!preg_match($regex, "/".$requestedPath)) {
                continue;
            }

            $controllerName = $route[1];
            $action = $route[2];
            $this->dispatch($controllerName, $action, $id);
            return;
        }

        throw ApplicationException::badRequest($requestedPath);
    }

    private function dispatch($controllerName, $action, $id) : void
    {
        $controller = null;
        $target = APPLICATION_ROOT .  DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $controllerName . 'Controller.php';
        if (file_exists($target)) {
            include_once($target);
            $class = "Stoa\\Controller\\" . $controllerName . "Controller";
            $controller = new $class($this->app);
        } else {
            throw ApplicationException::badRequest($route);
        }

        if ((int)method_exists($controller, $action)) {
            $request = Request::createFromGlobals();
            $response = call_user_func_array(array($controller,$action),array($request, $id));
            $response->send();
        } else {
            throw ApplicationException::badRequest($route);
        }
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
