<?php

namespace App\Domain\User\Exceptions;

class UserRepositoryException extends \Exception
{
    public static function emailAlreadyExists(): self
    {
        return new self("The given email already exists.");
    }

    public static function userNotFound(): self
    {
        return new self("The given user was not found.");
    }

}
