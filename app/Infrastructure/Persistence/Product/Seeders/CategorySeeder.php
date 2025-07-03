<?php

namespace App\Infrastructure\Persistence\Product\Seeders;

use App\Infrastructure\Persistence\Product\Models\CategoryModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        CategoryModel::factory()->count(10)->create();
    }

}
