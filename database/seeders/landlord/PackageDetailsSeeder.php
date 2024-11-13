<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\PackageDetails;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PackageDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageDetails::insert([
            [
                'package_id' => 1,
                'Price_monthly' => 0 ,
                'Price_annually' => 0,
                'storage_monthly' => 65,
                'storage_annually' => 65,
//                'interactive_archives' => 'Limited',
//                'custom_branding' => 'Not Included',
               // 'guest_users' => '10',
                'messages' => false,
                'notifications' => false,
                "main_show" => false,
                "main_search" => false,
                "statics" => false,
                'created_at' => Carbon::now(),
            ],
            [
                'package_id' => 2,
                'Price_monthly' => 600,
                'Price_annually' => 6000,
                'storage_monthly' => 10,
                'storage_annually' => 122,
//              'interactive_archives' => 'Included',
//              'custom_branding' => 'Limited',
//              'guest_users' => 'Included',
                'messages' => false,
                'notifications' => true,
                "main_show" => true,
                "main_search" => true,
                "statics" => false,
                'created_at' => Carbon::now(),
            ],
            [
                'package_id' => 3 ,
                'Price_monthly' => 1200,
                'Price_annually' => 12000,
                'storage_monthly' => 30,
                'storage_annually' => 40,
//                'interactive_archives' => 'Included',
//                'custom_branding' => 'Included',
               // 'guest_users' => 'Included',
                'messages' => false,
                'notifications' => true,
                "main_show" => true,
                "main_search" => true,
                "statics" => true,
                'created_at' => Carbon::now(),
            ],

        ]);

    }
}
