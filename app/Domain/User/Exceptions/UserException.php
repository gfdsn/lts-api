<?php

namespace App\Domain\User\Exceptions;

class UserException extends \Exception
{

    public static function noPermission(): self
    {
        return new self("You don't have permission to assign profiles.");
    }

    public static function profileAlreadyAssigned(): self
    {
        return new self("The User already has a profile.");
    }

}
