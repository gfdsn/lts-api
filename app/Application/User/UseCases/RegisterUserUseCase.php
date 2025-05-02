<?php

namespace App\Application\User\UseCases;

use App\Application\User\DTOs\UserRegisterDTO;
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
        /* prob Brevo integration here */
        /* notify admins bla bla bla*/
    }

}
