<?php

namespace Database\Seeders\landlord;


use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::insert([
            [
                'image' => 'logo-06.png',
                'email' => 'info@aitech.net.au',
                'facebook_link' => 'https://www.facebook.com/aitechnetau',
                'twitter_link' => 'https://twitter.com/aitechnetau',
                'whatsapp_link' => 'https://api.whatsapp.com/send/?phone=01003398033&text&type=phone_number&app_absent=0',
                'pinterest_link' => 'https://www.pinterest.com/aitechnetau/',
                'youtube_link' => 'https://www.youtube.com/@aitechnetau',
                'instagram_link' => 'https://www.instagram.com/aitechnetau/',
                'reddit_link' => 'https://www.reddit.com/user/aitechnetau/',
                'linkedin_link' => 'https://www.linkedin.com/company/aitechnetau/',
                'footer_image' => 'footer-logo.png',
                'desc' => 'We offer innovative AI solutions, devices and services with a customer centric approach and an expert team.',
                'copyright' => '©2023 All rights reserved | Ai Tech',
                'phone' => '+61 414 955 185',
                'address' => 'Egypt Office: 345 Al Mehwar Al Markazi, First 6th of October, Giza, Egypt.',
                'created_at' => now()
            ],
        ]);


    }
}
