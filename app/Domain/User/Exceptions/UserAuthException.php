<?php

namespace App\Domain\User\Exceptions;

class UserAuthException extends \Exception
{
    public static function incorrectPassword(): self
    {
        return new self("The given password is incorrect.");
    }
    public static function passwordsDoNotMatch(): self
    {
        return new self("The given passwords do not match.");
    }
    public static function invalidCredentials(): self
    {
        return new self("The given credentials are invalid.");
    }
}
