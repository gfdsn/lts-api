<?php

namespace App\Infrastructure\Persistence\User\Factories;

use App\Infrastructure\Persistence\User\Models\ProfileTypeModel;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserModelFactory extends Factory
{

    protected $model = UserModel::class;

    public function definition(): array
    {

        $name = $this->faker->name();
        return [
            'id' => $this->faker->uuid(),
            'name' => $name,
            'email' => Str::slug($name)."@email.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'profile_type_id' => ProfileTypeModel::where("id", "!=", 3)->get()->random()->id,
            'newsletter' => rand(0,1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
