<?php

namespace Stoa\Core;

use Stoa\Core\Exception\ApplicationException;

class Application
{
    public $container = null;

    public function __construct(array $params) {
        $this->container = $params;
    }

    public function getEntitymanager() {
        if (!$this->container['entity-manager']) {
            throw ApplicationException::applicationError("invalid configuration");
        }

        return $this->container['entity-manager'];
    }
}
