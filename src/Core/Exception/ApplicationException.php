<?php

namespace Stoa\Core\Exception;

use Exception;
use BadMethodCallException;

class ApplicationException extends Exception
{
    const INVALID_CONFIGURATION = 50000;

    public static function applicationError($message) {
        return new BadMethodCallException(
            sprintf("Application error: `%s`", $message),
            self::INVALID_CONFIGURATION
        );
    }
}
