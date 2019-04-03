<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Stoa\Core\Application;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;

class ControllerResolver extends BaseControllerResolver
{
    private $app;

    /**
     * @param Applciation $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        parent::__construct();
    }

    /**
     * @param string $class
     */
    protected function instantiateController($class) : object
    {
        return new $class($this->app);
    }
}
