<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\FeedBack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedBackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        FeedBack::insert([
            [
                'name' => 'John Doe',
                'email'=> 'example@gmail.com',
                'content'=> 'This Feedback.',
                'created_at' => now()
            ],
            [
                'name'=> 'John Doe 2',
                'email'=> 'adsa@gmail.com',
                'content' => 'test',
                'created_at'=> now()
            ]
        ]);
    }
}
