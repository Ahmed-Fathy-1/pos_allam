<?php

namespace Database\Seeders;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MadosUserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) { // Generate 50 random users
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Default password
                'phone' => $faker->phoneNumber,
                'role_name' => $faker->randomElement(['admin', 'user']),
                'is_block' => $faker->boolean,
                'image' => null, // You can set a random image URL if desired
                'created_at' => $this->randomDateTime(), // Random registration date
                'updated_at' => Carbon::now(), // Current time for updated_at
            ]);
        }
    }

    private function randomDateTime()
    {
        // Generate a random date within the last year
        return Carbon::now()->subDays(rand(0, 365));
    }
}