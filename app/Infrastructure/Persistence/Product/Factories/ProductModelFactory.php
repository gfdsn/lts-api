<?php

namespace App\Infrastructure\Persistence\Product\Factories;

use App\Infrastructure\Persistence\Product\Models\ProductModel;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use App\Infrastructure\Persistence\Product\Subdomains\Availability\Models\AvailabilityModel;
use App\Infrastructure\Persistence\Product\Subdomains\Category\Models\CategoryModel;
use App\Infrastructure\Persistence\User\Models\ProfileTypeModel;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductModelFactory extends Factory
{

    protected $model = ProductModel::class;

    public function definition(): array
    {
        $title = $this->faker->name();
        $price = rand(1000, 10000);
        $discount = rand(0, 25);

        return [
            'id' => $this->faker->uuid(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->text(150),
            'attributes' => [
                "weight" => rand(1, 10),
                "color" => $this->faker->colorName(),
            ],
            'measures' => [
                "length" => rand(1, 10),
                "width" => rand(1, 10),
                "height" => rand(1, 10),
            ],
            'classification' => [
                "category_id" => CategoryModel::all()->random()->id,
                "subcategory_id" => CategoryModel::all()->random()->id,
            ],
            'quotation' => [
                "price" => $price,
                "final_price" => $price - ($price * ($discount / 100)),
                "discount_value" => $discount,
            ],
            'images' => ["/assets/products/product_template.jpg", "/assets/products/product_template.jpg", "/assets/products/product_template.jpg"],
            'documentation' => ["doc1", "doc2", "doc3"],
            'stock' => rand(0,100),
            'accessories' => AccessoryModel::inRandomOrder()->limit(5)->pluck("id")->toArray(),
        ];
    }

}
