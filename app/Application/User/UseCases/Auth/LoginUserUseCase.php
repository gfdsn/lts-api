<?php

namespace App\Application\User\UseCases\Auth;

use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Exceptions\UserAuthException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginUserUseCase
{
    /*
        Create the domain and save to the db
        Return a token or throw errors
    */

    public function __construct(
        private AuthenticatorInterface $authenticator
    ){}

    /**
     * @throws UserAuthException
     */
    public function execute(LoginUserDTO $dto): ?string
    {
        $userModel = $this->authenticator->validate($dto->getEmail(), $dto->getPassword());

        return $this->authenticator->generateToken($userModel);
    }

}
