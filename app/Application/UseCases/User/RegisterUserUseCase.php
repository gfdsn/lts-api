<?php

namespace App\Application\UseCases\User;

use App\Application\DTOs\UserRegisterDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserException;
use App\Domain\User\Services\UserService;

readonly class RegisterUserUseCase
{

    public function __construct(
        private UserService $authService
    ) {}

    /**
     * @throws UserException
     */
    public function execute(UserRegisterDTO $userRegisterDTO): void
    {
        $user = $this->authService->register($userRegisterDTO);

        /* send a welcome email */
        /* notify admins bla bla bla*/
    }

}
