<?php

namespace Stoa\Core;

use Stoa\Core\Router;
use Symfony\Component\HttpFoundation\Request;

class Dispatcher {

    private $router;

    function __construct(Router $router) {
        $this->router = $router;
    }

    function handle(Request $request) {
        $handler = $this->router->match($request);
        if (!$handler) {
            echo "Could not find your resource!\n";
            return;
        }

        $handler();
    }

}
