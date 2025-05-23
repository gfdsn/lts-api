<?php

namespace App\Application\User\DTOs\Auth;

readonly class LoginUserDTO
{

    public function __construct(
        private string $email,
        private string $password
    ){}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}
