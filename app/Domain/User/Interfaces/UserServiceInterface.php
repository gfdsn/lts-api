<?php

namespace App\Domain\User\Interfaces;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\DTOs\CRUD\DeleteUserDTO;
use App\Application\User\DTOs\CRUD\UpdateUserDTO;
use App\Domain\User\Entities\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getAll(): Collection;
    public function register(RegisterUserDTO $dto): User;
    public function update(UpdateUserDTO $dto): User;
    public function delete(DeleteUserDTO $dto): bool;
}

