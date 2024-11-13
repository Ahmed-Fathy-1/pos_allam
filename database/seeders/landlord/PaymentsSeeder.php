<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::insert([
            [
                'user_id' => 1,
                'package_id' => 2,
                'amount' => '200',
                'domain_name' => 'abofathy',
                'created_at' => now()
            ],
            [
                'user_id' => 2,
                'package_id' => 3,
                'amount' => '300',
                'domain_name' => 'abofahd',
                'created_at'=> now()
            ]
        ]);
    }
}
