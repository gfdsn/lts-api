<?php

namespace App\Domain\User\Events;

use App\Infrastructure\Persistence\User\Models\UserModel;

final readonly class UserRegistered
{
    public function __construct(
        public UserModel $user
    ){}
}
