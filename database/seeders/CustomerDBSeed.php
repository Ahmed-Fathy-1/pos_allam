<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer1 = Customer::create([
            'name' => 'Alice Johnson',
            'abn' => '98765432109',
            'mobile' => '+61412345678',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3000',
            'city' => 'Melbourne',
            'address' => '123 King Street',
            "customer_id" => $customer1->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $customer2 = Customer::create([
            'name' => 'Bob Williams',
            'abn' => '45678901234',
            'mobile' => '+61423456789',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'QLD',
            'post_code' => '4000',
            'city' => 'Brisbane',
            'address' => '456 Queen Street',
            "customer_id" => $customer2->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $customer3 = Customer::create([
            'name' => 'Emma Davis',
            'abn' => '4567890123',
            'mobile' => '+61000456789',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'WA',
            'post_code' => '6000',
            'city' => 'Perth',
            'address' => '789 George Street',
            "customer_id" => $customer3->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $customer4 = Customer::create([
            'name' => 'Michael Brown',
            'abn' => '23456789012',
            'mobile' => '+61666456789',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'WA',
            'post_code' => '6000',
            'city' => 'Perth',
            'address' => '101 William Street',
            "customer_id" => $customer4->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $customer5= Customer::create([
            'name' => 'Greenfield Corporation',
            'abn' => '56789012345',
            'mobile' => '+61456789012',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'SA',
            'post_code' => '5000',
            'city' => 'Adelaide',
            'address' => '222 Adelaide Street',
            "customer_id" => $customer5->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        for ($i = 7 ; $i<=9; $i++){
            Address::create([
                'state' => 'SA',
                'post_code' => '5000',
                'city' => 'Adelaide',
                'address' => '2'.$i.'2 Adelaide Street',
                "user_id" => $i,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }

    }
}
