<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Stoa\Core\Router;
use Stoa\Core\Application;
use Stoa\Core\ControllerResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class Dispatcher
{
    private $router;

    private $app;

    function __construct(Application $app, Router $router)
    {
        $this->router = $router;
        $this->app = $app;
    }

    public function dispatch()
    {
        $routes = $this->router->getRoutes();

        $request = Request::createFromGlobals();

        $matcher = new UrlMatcher($routes, new RequestContext());

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

        $controllerResolver = new ControllerResolver($this->app);
        $argumentResolver = new ArgumentResolver();

        $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

        $response = $kernel->handle($request);
        $response->send();

        $kernel->terminate($request, $response);
    }
}
