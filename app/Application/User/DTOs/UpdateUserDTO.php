<?php

namespace App\Application\User\DTOs;

readonly class UpdateUserDTO
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $currentPassword,
        private string $newPassword,
        private string $passwordConfirmation
    )
    {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }

    public function toUpdateArray(): array
    {
        return ["name" => $this->name, "email" => $this->email, "password" => $this->newPassword];
    }

}
