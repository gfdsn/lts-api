<?php

namespace App\Infrastructure\Persistence\Product\Subdomains\Availability\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvailabilitySeeder extends Seeder
{

    public function run():void
    {
        DB::table('availabilities')->insert([
            ["name" => "Available"], ["name" => "Order only"], ["name" => "Out of stock"]
        ]);
    }

}
