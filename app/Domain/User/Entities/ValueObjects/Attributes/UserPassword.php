<?php

namespace App\Domain\User\Entities\ValueObjects\Attributes;

use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

readonly class UserPassword
{
    private string $value;

    public function __construct(string $password)
    {
        /* Add Validations */

        if (strlen($password) < 8)
            throw new InvalidArgumentException("Password must be at least 8 characters long");

        $this->value = Hash::make($password);
    }

    public function get(): string
    {
        return $this->value;
    }

    public function validate(string $passwordAsText): bool
    {
        return Hash::check($passwordAsText, $this->value);
    }

}
