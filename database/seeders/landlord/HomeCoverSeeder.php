<?php

namespace Database\Seeders\landlord;


use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\HomeCover;

class HomeCoverSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        HomeCover::insert([
            [
                'image' => 'logo-06.png',
                'title' => 'Welcome to Ai Tech',
                'sub_title' => 'We offer innovative AI solutions',
                'description' => 'We offer innovative AI solutions, devices and services with a customer centric approach and an expert team.',
                'created_at' => now()
            ],
        ]);


    }
}
