<?php

namespace Database\Seeders\landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\FAQ;


class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            FAQ::insert([
                [
                    'question' => 'What is the best way to get started with Laravel?',
                    'answer' => 'The best way to get started with Laravel is to follow the official documentation. The documentation is very detailed and covers everything you need to know to get started with Laravel. You can find the official documentation at https://laravel.com/docs/8.x.'
                ],
                [
                    'question' => 'What is the best way to learn Laravel?',
                    'answer' => 'The best way to learn Laravel is to follow the official documentation and build projects. The documentation is very detailed and covers everything you need to know to get started with Laravel. You can find the official documentation at https://laravel.com/docs/8.x.'
                ],
                [
                    'question' => 'What is the best way to get help with Laravel?',
                    'answer' => 'The best way to get help with Laravel is to join the Laravel community. There are many Laravel forums and chat rooms where you can ask questions and get help from other Laravel developers. You can also find help on the official Laravel documentation at https://laravel.com/docs/8.x.'
                ],
                [
                    'question' => 'What is the best way to get help with Laravel?',
                    'answer' => 'The best way to get help with Laravel is to join the Laravel community. There are many Laravel forums and chat rooms where you can ask questions and get help from other Laravel developers. You can also find help on the official Laravel documentation at https://laravel.com/docs/8.x.'
                ],
                [
                    'question' => 'What is the best way to get started with Laravel?',
                    'answer' => 'The best way to get started with Laravel is to follow the official documentation. The documentation is very detailed and covers everything you need to know to get started with Laravel. You can find the official documentation at https://laravel.com/docs/8.x.'
                ],
                [
                    'question' => 'What is the best way to learn Laravel?',
                    'answer' => 'The best way to learn Laravel is to follow the official documentation and build projects. The documentation is very detailed and covers everything you need to know to get started with Laravel. You can find the official documentation at https://laravel.com/docs/8.x.'
                ],
            ]);

    }
}
