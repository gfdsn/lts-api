<?php

namespace App\Application\User\DTOs;

readonly class CreateUserDTO
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password,
        private string $passwordConfirmation
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }
}
