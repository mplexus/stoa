<?php

namespace Stoa\Core;

use Symfony\Component\HttpFoundation\Request;

class Router {

    private $routes = [
        'get' => [],
        'post' => []
    ];

    function get($pattern, callable $handler) {
        $this->routes['get'][$pattern] = $handler;
        return $this;
    }

    function post($pattern, callable $handler) {
        $this->routes['post'][$pattern] = $handler;
        return $this;
    }

    function match(Request $request) {
        $method = strtolower($request->getMethod());
        if (!isset($this->routes[$method])) {
            return false;
        }

        $path = $request->getPathInfo();
        $path = trim($path, '/');
        foreach ($this->routes[$method] as $pattern => $handler) {
            if ($pattern === $path) {
                return $handler;
            }
        }

        return false;
    }

}
