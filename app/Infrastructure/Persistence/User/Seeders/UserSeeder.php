<?php

namespace App\Infrastructure\Persistence\User\Seeders;

use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        UserModel::factory()->count(10)->create();
    }

}
