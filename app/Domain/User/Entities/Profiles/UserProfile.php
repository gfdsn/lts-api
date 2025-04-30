<?php

namespace App\Domain\User\Entities\Profiles;

interface UserProfile
{
    public function can(string $action): bool;
    public function getType(): string;
}
