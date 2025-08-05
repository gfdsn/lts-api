<?php

namespace App\Domain\User\Interfaces;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\DTOs\CRUD\DeleteUserDTO;
use App\Application\User\DTOs\CRUD\UpdateUserDTO;
use App\Domain\User\Entities\User;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getAll(): Collection;
    public function find(string $id): UserModel;
    public function register(RegisterUserDTO $dto): User;
    public function update(UpdateUserDTO $dto): User;
    public function delete(DeleteUserDTO $dto): bool;
    public function emailExists(string $email): bool;
    public function monthlyStats(): array;

}

