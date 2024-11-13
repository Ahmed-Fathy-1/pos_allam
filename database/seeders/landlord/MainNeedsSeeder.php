<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\Needes\MainNeed;
use Illuminate\Database\Seeder;

class MainNeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainNeed::create([
            'title' => 'Costumers Needs For Enterprise',
            'image' => 'main_needs_img.jpg',
            'desc' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
