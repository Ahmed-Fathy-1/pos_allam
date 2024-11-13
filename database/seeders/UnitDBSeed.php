<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::insert([
            [
                "name" => "Kilo",
                "user_id" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Box",
                "user_id" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Quarter",
                "user_id" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Half",
                "user_id" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
