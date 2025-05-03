<?php

namespace Database\Seeders;

use App\Domain\User\Enums\UserProfileType;
use App\Infrastructure\Persistence\User\Eloquent\ProfileTypeRepository;
use Illuminate\Database\Seeder;

class ProfileTypeSeeder extends Seeder
{
    public function run(): void
    {
        $profileTypes = [
            UserProfileType::INDIVIDUAL->value,
            UserProfileType::ENTERPRISE->value,
            UserProfileType::ADMIN->value,
        ];

        foreach ($profileTypes as $pType) {
            app(ProfileTypeRepository::class)->save($pType);
        }
    }
}
