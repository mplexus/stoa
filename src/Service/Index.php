<?php

namespace Stoa\Service;

use Stoa\Core\Exception\ApplicationException;

class Index extends Base
{
    public function getResource() {
        throw ApplicationException::badRequest('index');
    }
}
