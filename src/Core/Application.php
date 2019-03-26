<?php

namespace Stoa\Core;

class Application
{
    public $container = null;

    public function __construct(array $params) {
        $this->container = $params;
    }
}
