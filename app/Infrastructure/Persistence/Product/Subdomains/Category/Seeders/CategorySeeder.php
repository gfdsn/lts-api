<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Category\Seeders;

use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        CategoryModel::factory()->count(10)->create();
    }

}
