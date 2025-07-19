<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Product\Seeders\ProductSeeder;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Seeders\AccessorySeeder;
use App\Infrastructure\Persistence\Product\Subdomains\Availability\Seeders\AvailabilitySeeder;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Seeders\CategorySeeder;
use App\Infrastructure\Persistence\User\Seeders\ProfileTypeSeeder;
use App\Infrastructure\Persistence\User\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProfileTypeSeeder::class,
            UserSeeder::class,
            AvailabilitySeeder::class,
            AccessorySeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
