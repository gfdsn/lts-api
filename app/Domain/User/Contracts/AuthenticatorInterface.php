<?php

namespace App\Domain\User\Contracts;

use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserAuthException;
use App\Infrastructure\Persistence\User\Models\UserModel;

interface AuthenticatorInterface
{
    /**
     * @throws UserAuthException
     */
    public function validate(string $email, string $password): ?UserModel;
    public function generateToken(UserModel $user): string;
}
