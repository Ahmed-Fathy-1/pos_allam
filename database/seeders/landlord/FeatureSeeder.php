<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\Features\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'main_title' => 'Check out our premium features',
            'main_description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.',
            'feature_1_title' => 'Esay Features',
            'feature_1_image' => 'feature_1.jpg',
            'feature_1_description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
            'feature_2_title' => 'Good user Experience',
            'feature_2_image' => 'feature_2.jpg',
            'feature_2_description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
            'feature_3_title' => 'Clen Design',
            'feature_3_image' => 'feature_3.jpg',
            'feature_3_description' => 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
