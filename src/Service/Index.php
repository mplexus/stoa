<?php

declare(strict_types = 1);

namespace Stoa\Service;

use Stoa\Core\Exception\ApplicationException;

class Index extends Base
{
    /**
     * @throws ApplicationException
     */
    public function getResource() : void
    {
        throw ApplicationException::badRequest('index');
    }

    /**
     * @inheritdoc
     * @throws ApplicationException
     */
    public function addListBuilders() : void
    {
        throw ApplicationException::badRequest('index');
    }
}
