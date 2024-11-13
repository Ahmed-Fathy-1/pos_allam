<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\Needes\SubNeeds;
use Illuminate\Database\Seeder;

class SubNeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubNeeds::insert([
            [
                'title' => 'Industry Standard Protocols',
                'image' => 'sub_need_1.jpg',
                'desc' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
                'main_need_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'On Premisee , In Clouds',
                'image' => 'sub_need_2.jpg',
                'desc' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
                'main_need_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Compliance and Certification',
                'image' => 'sub_need_3.jpg',
                'desc' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
                'main_need_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
