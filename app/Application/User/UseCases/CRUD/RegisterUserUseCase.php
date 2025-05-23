<?php

namespace App\Application\User\UseCases\CRUD;

use App\Application\User\DTOs\CRUD\CreateUserDTO;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Services\UserService;

readonly class RegisterUserUseCase
{

    public function __construct(
        private UserService $userService
    ) {}

    /**
     * @throws UserAuthException
     * @throws UserRepositoryException
     */
    public function execute(CreateUserDTO $userRegisterDTO): void
    {
        $user = $this->userService->register($userRegisterDTO);

        /* TODO: send a welcome email */
        /* TODO: prob Brevo integration here */
        /* TODO: notify admins bla bla bla*/
    }

}
