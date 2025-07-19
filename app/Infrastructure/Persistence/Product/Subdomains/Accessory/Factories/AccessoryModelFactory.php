<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Accessory\Factories;

use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoryModelFactory extends Factory
{

    protected $model = AccessoryModel::class;

    public function definition(): array
    {
       return [
           "id" => $this->faker->uuid(),
           "name" => $this->faker->name(),
           "details" => $this->faker->text(50),
           "price" => $this->faker->randomNumber(2, 10),
           "stock" => rand(0, 30),
           "image" => "/assets/products/product_template.jpg"
       ];
    }
}
