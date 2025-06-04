<?php

namespace App\Domain\User\Services;

use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Interfaces\AuthServiceInterface;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

readonly class AuthService implements AuthServiceInterface
{


    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){}

    public function saveResetToken(string $email, string $key): void
    {
        DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $email,
            'token' => Hash::make($key),
            'created_at' => now(),
        ]);
    }

    /**
     * @throws UserAuthException
     */
    public function verifyResetToken(string $email, string $token): bool
    {
        $record = DB::table('password_reset_tokens')->where(["email" => $email])->firstOrFail();

        if (!$record->exists() || $record->token != $token)
            throw UserAuthException::invalidCredentials();

        return true;
    }

    public function resetPassword(string $email, string $token, string $password): void
    {
        // should not get here if the user does not exist

        // remove the token from the db
        DB::table('password_reset_tokens')->where(["email" => $email, "token" => $token])->delete();

        // updating the password
        $user = $this->userRepository->findByEmail($email);

        $user->update(['password' => Hash::make($password)]);
    }

}
