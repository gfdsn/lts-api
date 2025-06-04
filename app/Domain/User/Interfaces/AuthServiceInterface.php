<?php

namespace App\Domain\User\Interfaces;

interface AuthServiceInterface
{
    public function saveResetToken(string $email, string $key): void;
    public function verifyResetToken(string $email, string $token): bool;
    public function resetPassword(string $email, string $token, string $password): void;
}
