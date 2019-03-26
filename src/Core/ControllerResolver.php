<?php

namespace Stoa\Core;

use Stoa\Core\Application;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;

class ControllerResolver extends BaseControllerResolver
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        parent::__construct();
    }

    protected function instantiateController($class)
    {
        return new $class($this->app);
    }
}
