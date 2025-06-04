<?php

namespace App\Application\User\DTOs\Auth;

readonly class ForgotPasswordDTO
{

    public function __construct(
        private string $email,
    ){}

    public function getEmail(): string
    {
        return $this->email;
    }


}
