<?php

namespace App\Domain\User\Interfaces;

use App\Infrastructure\Persistence\User\Models\UserModel;

interface TokenServiceInterface
{
    public function generateToken(UserModel $user): string;
}
