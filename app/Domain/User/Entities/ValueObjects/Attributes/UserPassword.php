<?php

namespace App\Domain\User\Entities\ValueObjects\Attributes;

use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

readonly class UserPassword
{
    private string $value;

    public function __construct(string $password)
    {
        if (Hash::isHashed($password)){
            $this->value = $password;
        } else {
            if (!$this->validate($password))
                throw new InvalidArgumentException(
                    "Password must be at least 8 characters, 1 Upper case, 1 Number and 1 Special letter."
                );

            $this->value = Hash::make($password);
        }
    }
    public function get(): string
    {
        return $this->value;
    }

    public function check(string $password): bool
    {
        return Hash::check($password, $this->value);
    }

    public static function validate(string $password): bool
    {
        $blacklist = ['12345678', 'pass', 'password', 'admin', 'administrator', 'adm', 'password1', 'pass1234'/* , ... add more if needed */];
        $lowercasedPassword = strtolower($password); // avoid 'Password' != 'password'

        return
            strlen($password) >= 8 && // len > 8
            preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/', $password) && // 1 upper case, 1 number and 1 special letter regex
            !in_array($lowercasedPassword, $blacklist, true);
    }

    /* TODO: TEST THIS */
    public function equals(string $hashedPassword): bool
    {
        return $this->value === $hashedPassword;
    }

}
