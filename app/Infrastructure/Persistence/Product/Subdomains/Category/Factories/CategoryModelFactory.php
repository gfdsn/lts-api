<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Category\Factories;

use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryModelFactory extends Factory
{

    protected $model = CategoryModel::class;

    public function definition(): array
    {
        return [
            "id" => $this->faker->uuid(),
            "name" => $this->faker->name(),
            "slug" => $this->faker->slug(),
            "icon" => $this->faker->imageUrl(),
        ];
    }
}
