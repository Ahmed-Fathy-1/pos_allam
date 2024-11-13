<?php

namespace Database\Seeders\landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\Technology;

class TechnologySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technology::insert([
            [
                'name'=> 'Laravel',
                'image'=>  '/image2.png',
                'created_at' => now()
            ],
            [
                'name'=> 'Vue',
                'image'=>  '/image.png',
                'created_at'=> now()
            ],
            [
                'name'=> 'Vite',
                'image'=>  '/image3.png',
                'created_at' => now()
            ],
            [
                'name'=> 'Bootstrap',
                'image'=>  '/image4.png',
                'created_at'=> now()
            ]
        ]);
    }
}
