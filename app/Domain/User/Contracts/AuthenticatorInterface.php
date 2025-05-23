<?php

namespace App\Domain\User\Contracts;

use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Infrastructure\Persistence\User\Models\UserModel;

interface AuthenticatorInterface
{
    /**
     * @throws UserAuthException
     */
    public function validateLoginPayload(string $email, string $password): ?UserModel;

    /**
     * @throws UserRepositoryException
     */
    public function validateRegisterPayload(string $email, string $password): bool;
}
