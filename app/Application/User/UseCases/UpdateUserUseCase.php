<?php

namespace App\Application\User\UseCases;

use App\Application\User\DTOs\UpdateUserDTO;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Services\UserService;

readonly class UpdateUserUseCase
{
    public function __construct(
        private UserService $userService
    ) {}

    /**
     * @throws UserRepositoryException
     * @throws UserAuthException
     */
    public function execute(UpdateUserDTO $dto): void
    {
        /* update user info */
        $user = $this->userService->update($dto);

        /* TODO: send email notifying of the update*/
    }

}
