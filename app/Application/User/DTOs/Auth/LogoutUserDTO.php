<?php

namespace App\Application\User\DTOs\Auth;

readonly class LogoutUserDTO
{

    public function __construct(
        private string $token,
    ){}

    public function getToken(): string
    {
        return $this->token;
    }

}
