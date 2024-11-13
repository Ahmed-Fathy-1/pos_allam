<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'intro_title' => 'About Us',
            'intro_desc' => 'You will find a very high performance and awesome collection from professional web developers and AI programmers working together.',
            'numbers_clients_title' => 'Start Client',
            'numbers_clients_count' => '21k',
            'numbers_downloads_title' => 'Apps Download',
            'numbers_downloads_count' => '100k',
            'numbers_projects_title' => 'Start Client',
            'numbers_projects_count' => '100k',
            'workflow_title' => 'How It Works',
            'workflow_desc' => 'Our Cashier Work Flow',
            'workflow_download_title' => 'Download & Register',
            'workflow_download_desc' => 'Integer vitae lacus eu magna bibendum pellentesque. In ullamcorper, lacus et consectetur pellentesque, nulla enim.',
            'workflow_download_number' => 1,
            'workflow_download_image' => 'flow-1.png',
            'workflow_manage_title' => 'Manage Projects',
            'workflow_manage_desc' => 'Integer vitae lacus eu magna bibendum pellentesque. In ullamcorper, lacus et consectetur pellentesque, nulla enim.',
            'workflow_manage_number' => 2,
            'workflow_manage_image' => 'flow-2.png',
            'workflow_edit_title' => 'Edit Projects',
            'workflow_edit_desc' => 'Integer vitae lacus eu magna bibendum pellentesque. In ullamcorper, lacus et consectetur pellentesque, nulla enim.',
            'workflow_edit_number' => 3,
            'workflow_edit_image' => 'flow-3.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
