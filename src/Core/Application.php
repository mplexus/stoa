<?php

declare(strict_types = 1);

namespace Stoa\Core;

use Stoa\Core\Helper;
use Stoa\Core\Exception\ApplicationException;

class Application
{
    /**
     * @var array
     */
    protected $container = null;

    public function __construct(array $params)
    {
        $this->container = $params;
    }

    /**
     * @param string|object $name
     * @throws ApplicationException
     */
    public function __get ($name)
    {
        $key = Helper::uncamelCase($name);

        if (!array_key_exists($key, $this->container)) {
            throw ApplicationException::applicationError("invalid configuration");
        }

        return $this->container[$key];
    }
}
