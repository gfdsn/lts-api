<?php

namespace App\Domain\User\Entities\Profiles;

use App\Domain\User\Entities\ValueObjects\Permissions;
use App\Domain\User\Enums\UserProfileType;

class EnterpriseProfile implements UserProfile
{

    /* MOVE TO CONST WHEN ADDING DATABASES */
    private readonly Permissions $permissions;

    public function __construct()
    {
        $this->permissions = new Permissions(["view_personal_enterprise_dashboard"] /* , ... */);
    }

    public function can(string $action): bool
    {
        return $this->permissions->has($action) ?? false;
    }

    public function getType(): string
    {
        return UserProfileType::ENTERPRISE->value;
    }
}
