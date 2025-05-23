<?php

namespace App\Domain\User\Services;

use App\Domain\User\Interfaces\TokenServiceInterface;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Tymon\JWTAuth\JWTAuth;

readonly class TokenService implements TokenServiceInterface
{
    public function __construct(
        private JWTAuth $jwt,
    ) {}

    public function generateToken(UserModel $user): string
    {
        return $this->jwt->fromUser($user);
    }
}
