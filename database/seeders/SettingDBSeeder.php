<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
          DB::table('settings')->truncate();
        Schema::enableForeignKeyConstraints();

        Setting::insert([
            [
                'key'           => 'site_name',
                'value'         => 'Abu-Sara',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'logo',
                'value'         => null,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'open_today',
                'value'         => '8 AM -  11 PM',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'mobile',
                'value'         => '0394626632',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'phone',
                'value'         => '0394626632',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'facebook_link',
                'value'         => 'https://www.facebook.com/e-commerceButcher',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'twitter_link',
                'value'         => '',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'instagram_link',
                'value'         => '',
                'created_at'    => now(),
                'updated_at'    => now()
            ],

           /* [
                'key'           => 'post_code',
                'value'         => '3073',
                'created_at'    => now(),
                'updated_at'    => now()
            ],*/
            [
                'key'           => 'shipping',
                'value'         => '0',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'address',
                'value'         => '266 BROADWAY, RESERVOIR, VIC 3073',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'email',
                'value'         => 'test_email@test.com',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'abn',
                'value'         => '25612588762',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'key'           => 'amount_remove',
                'value'         => '5',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);

    }
}
