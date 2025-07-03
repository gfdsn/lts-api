<?php

namespace App\Application\User\UseCases\CRUD;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Events\UserRegistered;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Interfaces\UserServiceInterface;

readonly class StoreUserUseCase
{

    public function __construct(
        private UserServiceInterface $userService
    ) {}

    public function execute(RegisterUserDTO $dto): User
    {
        return $this->userService->register($dto);
    }

}
