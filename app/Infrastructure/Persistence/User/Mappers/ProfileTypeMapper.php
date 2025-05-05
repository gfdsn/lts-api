<?php

namespace App\Infrastructure\Persistence\User\Mappers;

use App\Domain\User\Entities\Profiles\AdminProfile;
use App\Domain\User\Entities\Profiles\EnterpriseProfile;
use App\Domain\User\Entities\Profiles\IndividualProfile;
use App\Domain\User\Entities\Profiles\UserProfile;
use App\Domain\User\Enums\UserProfileType;
use App\Infrastructure\Persistence\User\Models\ProfileTypeModel;

class ProfileTypeMapper
{

    public static function toModel(string $profile): ProfileTypeModel
    {
        return new ProfileTypeModel(["name" => $profile]);
    }

    public static function toDomain(ProfileTypeModel $profile): UserProfile
    {
        return match($profile->name){
            UserProfileType::INDIVIDUAL->value => new IndividualProfile(),
            UserProfileType::ENTERPRISE->value => new EnterpriseProfile(),
            UserProfileType::ADMIN->value => new AdminProfile(),
            default => throw new \InvalidArgumentException("Invalid profile type."),
        };
    }
}
