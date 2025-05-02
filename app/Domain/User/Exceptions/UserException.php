<?php

namespace App\Domain\User\Exceptions;

class UserException extends \Exception
{
    public static function noPermission(): self
    {
        return new self("You don't have permission to assign profiles.");
    }

    public static function productionProfileAssignation(): self
    {
        return new self("Cannot assign profile directly in production.");
    }

    public static function emailAlreadyExists(): self
    {
        return new self("The given email already exists.");
    }
}
