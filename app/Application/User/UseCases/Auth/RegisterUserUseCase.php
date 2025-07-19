<?php

namespace App\Application\User\UseCases\Auth;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\UseCases\CRUD\StoreUserUseCase;
use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Interfaces\TokenServiceInterface;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;

readonly class RegisterUserUseCase
{

    public function __construct(
        private AuthenticatorInterface $authenticator,
        private TokenServiceInterface $tokenService,
        private StoreUserUseCase $storeUseCase,
    ){}

    /**
     * @throws UserRepositoryException
     */
    public function execute(RegisterUserDTO $dto): array
    {
        /*
            validates if email already exists
            TODO: validate the password
        */
        $this->authenticator->validateRegisterPayload($dto->getEmail(), $dto->getPassword());

        /* saves the user to database and returns a User Domain obj */
        $user = $this->storeUseCase->execute($dto);

        $userModel = UserMapper::toModel($user); // User Model

        return ["token" => $this->tokenService->generateToken($userModel), "user" => $userModel];

        /* TODO: notify admins bla bla bla*/


        /* TODO: send a welcome email */
            /* TODO: add a verify email link */

        /* TODO: prob Brevo integration here */

    }

}
