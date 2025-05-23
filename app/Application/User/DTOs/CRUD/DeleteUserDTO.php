<?php

namespace App\Application\User\DTOs\CRUD;

readonly class DeleteUserDTO
{


    public function __construct(
        private string $id,
        private string $password,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


}
