<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => "Mohamed Ibrahim",
                "email" => "user@user.com",
                "mobile" => "012253722",
                "password" =>bcrypt('12345678'),
                "email_verified_at" => now(),
                "mobile_verified_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => "khaled Ali",
                "email" => "user2@user.com",
                "mobile" => "0145253722",
                "password" =>bcrypt('12345678'),
                "email_verified_at" => now(),
                "mobile_verified_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => "Yasser sayed",
                "email" => "user3@user.com",
                "mobile" => "0105253722",
                "password" =>bcrypt('12345678'),
                "email_verified_at" => now(),
                "mobile_verified_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
