<?php

namespace Stoa\Core\Exception;

use Exception;
use BadMethodCallException;

class ApplicationException extends Exception
{
    const INVALID_CONFIGURATION = 50000;
    const INVALID_RESOURCE = 50001;

    public static function applicationError($message) {
        return new BadMethodCallException(
            sprintf("Application error: `%s`", $message),
            self::INVALID_CONFIGURATION
        );
    }

    public static function badRequest($message) {
        return new BadMethodCallException(
            sprintf("Invalid resource: `%s`", $message),
            self::INVALID_RESOURCE
        );
    }
}
