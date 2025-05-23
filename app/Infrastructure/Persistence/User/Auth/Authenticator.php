<?php

namespace App\Infrastructure\Persistence\User\Auth;

use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class Authenticator implements AuthenticatorInterface
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){}

    /**
     * @throws UserAuthException
     */
    public function validate(string $email, string $password): ?UserModel
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password))
            throw UserAuthException::invalidCredentials();

        return $user;
    }
}
