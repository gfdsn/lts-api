<?php

namespace App\Domain\User\Entities\ValueObjects\Attributes;

use InvalidArgumentException;

readonly class UserEmail
{

    private string $value;

    public function __construct(string $email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new InvalidArgumentException("The given email is invalid");

        $this->value = $email;
    }

    public function value(): string
    {
        return $this->value;
    }
}
