<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Seeders;

use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use Illuminate\Database\Seeder;

class AccessorySeeder extends Seeder
{

    public function run(): void
    {
        AccessoryModel::factory()->count(20)->create();
    }

}
