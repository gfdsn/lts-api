<?php

namespace App\Application\User\DTOs\Auth;

readonly class ResetPasswordDTO
{

    public function __construct(
        private string $email,
        private string $token,
        private string $password
    ){}

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getToken(): string
    {
        return $this->token;
    }

}
