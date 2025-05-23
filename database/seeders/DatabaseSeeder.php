<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\User\Seeders\ProfileTypeSeeder;
use App\Infrastructure\Persistence\User\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProfileTypeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
