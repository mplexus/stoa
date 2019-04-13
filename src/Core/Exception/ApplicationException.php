<?php

declare(strict_types = 1);

namespace Stoa\Core\Exception;

use Exception;
use BadMethodCallException;
use UnexpectedValueException;

class ApplicationException extends Exception
{
    const INVALID_CONFIGURATION = 50000;
    const INVALID_RESOURCE = 50001;
    const RESOURCE_ITEM_NOT_FOUND = 50002;

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

    /**
     * @param string $resource
     * @param string $id
     * @return UnexpectedValueException
     */
    public static function resourceItemNotFound($resource, $id) : UnexpectedValueException
    {
        return new UnexpectedValueException(
            sprintf("Cannot find `%s` with id `%s`", $resource, $id),
            self::RESOURCE_ITEM_NOT_FOUND
        );
    }
}
