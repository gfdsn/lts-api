<?php

namespace App\Application\User\UseCases\Auth;

use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Interfaces\TokenServiceInterface;

readonly class LoginUserUseCase
{
    public function __construct(
        private AuthenticatorInterface $authenticator,
        private TokenServiceInterface $tokenService
    ){}

    /**
     * @throws UserAuthException
     */
    public function execute(LoginUserDTO $dto): ?string
    {
        $userModel = $this->authenticator->validateLoginPayload($dto->getEmail(), $dto->getPassword());

        return $this->tokenService->generateToken($userModel);
    }

}
