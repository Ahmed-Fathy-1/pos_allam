<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\Package;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::insert([
            [
                'title' => 'Free' ,
                'description' => 'start free' ,
                'user_id' => '1' ,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Teacher' ,
                'description' => 'Individual Teachers  ' ,
                'user_id' => '1' ,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Centers' ,
                'description' => 'Centers' ,
                'user_id' => '1' ,
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
