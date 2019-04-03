<?php

declare(strict_types = 1);

namespace Stoa\Core\Exception;

use Exception;
use BadMethodCallException;

class ApplicationException extends Exception
{
    const INVALID_CONFIGURATION = 50000;
    const INVALID_RESOURCE = 50001;

    /**
    * @param string|null $message
    * @return BadMethodCallException
     */
    public static function applicationError($message = '') : BadMethodCallException
    {
        return new BadMethodCallException(
            sprintf("Application error: `%s`", $message),
            self::INVALID_CONFIGURATION
        );
    }

    /**
     * @param string|null $message
     * @return BadMethodCallException
     */
    public static function badRequest($message = '') : BadMethodCallException
    {
        return new BadMethodCallException(
            sprintf("Invalid resource: `%s`", $message),
            self::INVALID_RESOURCE
        );
    }
}
