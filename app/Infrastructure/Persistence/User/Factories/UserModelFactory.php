<?php

namespace App\Infrastructure\Persistence\User\Factories;

use App\Infrastructure\Persistence\User\Models\ProfileTypeModel;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserModelFactory extends Factory
{

    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'profile_type_id' => ProfileTypeModel::where("id", "!=", 3)->get()->random()->id,
            'newsletter' => rand(0,1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
