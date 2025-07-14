<?php

namespace App\Application\User\UseCases\Auth;

use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Interfaces\TokenServiceInterface;
use Tymon\JWTAuth\JWTAuth;

readonly class LoginUserUseCase
{
    public function __construct(
        private AuthenticatorInterface $authenticator,
        private TokenServiceInterface $tokenService,
        private JWTAuth $jwt,
    ){}

    /**
     * @throws UserAuthException
     */
    public function execute(LoginUserDTO $dto): array
    {

        /*
         * Store a session identifier in the JWT and maintain a list of active session IDs on the server.
         * Invalidate sessions by removing their IDs from the active list.
         */

        if (auth()->check()) // basically if there's a token in the request
            $this->jwt->invalidate($this->jwt->getToken());

        $userModel = $this->authenticator->validateLoginPayload($dto->getEmail(), $dto->getPassword());

        return ["token" => $this->tokenService->generateToken($userModel), "user" => $userModel];
    }

}
