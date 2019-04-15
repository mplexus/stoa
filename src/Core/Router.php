<?php

declare(strict_types = 1);

namespace Stoa\Core;

class Router
{

    /**
     * @var array
     */
    private $routes = null;

    public function __construct()
    {
        if ($this->routes == null) {
            $this->routes = [];

            $this->setRoutes();
        }
    }

    private function setRoutes() : void
    {
        $this->routes[] = ['/stats', 'Index', 'statsAction'];

        $this->routes[] = ['/orders', 'Order', 'listAction'];

        $this->routes[] = ['/orders/\S+', 'Order', 'viewAction'];

        $this->routes[] = ['/customers', 'Customer', 'listAction'];

        $this->routes[] = ['/index', 'Index', 'indexAction'];

        $this->routes[] = ['/', 'Index', 'indexAction'];
    }

    /**
     * @return array
     */
    public function getRoutes() : array
    {
        return $this->routes;
    }
}
