<?php

namespace App\Domain\User\Entities\Profiles;

use App\Domain\User\Enums\UserProfileType;

class AdminProfile implements UserProfile
{

    public function can(string $action): bool
    {
        return true; // Admins should have permission to do anything.
    }

    public function getType(): string
    {
        return UserProfileType::ADMIN->value;
    }
}
