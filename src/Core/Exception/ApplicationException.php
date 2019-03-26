<?php

namespace Stoa\Core\Exception;

use Exception;

class ApplicationException extends Exception
{
    const INVALID_CONFIGURATION = 50000;

    public static function applicationError($message) {
        return BadMethodCallException(
            sprintf("Application error: `%s`", $message),
            self::INVALID_CONFIGURATION
        );
    }
}
