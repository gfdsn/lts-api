<?php

namespace App\Application\User\UseCases\CRUD;

use App\Application\User\DTOs\CRUD\DeleteUserDTO;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Interfaces\UserServiceInterface;

readonly class DeleteUserUseCase
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * @throws UserRepositoryException
     * @throws UserAuthException
     */
    public function execute(DeleteUserDTO $dto): void
    {
        /* delete user */
        $user = $this->userService->delete($dto);

        /* TODO: send email notifying of the deletion*/
    }

}
