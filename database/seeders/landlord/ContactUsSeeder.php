<?php

namespace Database\Seeders\landlord;
use App\Models\SuperAdmin\ContactUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            ContactUs::create([
                'name' => $faker->name . ' ' . $i,
                'email' => "user{$i}_" . $faker->unique()->safeEmail,
                'phone' => $faker->unique()->phoneNumber,
                'subject' => $faker->sentence . " #{$i}",
                'message' => $faker->paragraph,
            ]);
        }
    }
}
