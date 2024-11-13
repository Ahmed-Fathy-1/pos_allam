<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
           'code' => "#AiTech#",
            "limit" => 10,
            "discount" => 10,
            "start_at" => now(),
            "end_at" => '2024-04-29 12:00:00',
            "user_id" => 1
        ]);
    }
}
