<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Console\Command;

class NewCustomerDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->getOutput()->progressStart(13);
        $customer1 = Customer::create([
            'name' => 'Shako Mako Restaurant',
            'mobile' => '+61383493394',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Melbourne',
            'address' => 'Roxburgh Park',
            "customer_id" => $customer1->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer2 = Customer::create([
            'name' => 'Al Tanoor Restaurant',
            'mobile' => '+61383392572',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Melbourne',
            'address' => 'Roxburgh Village, Roxburgh Park Shopping Centre, 2...',
            "customer_id" => $customer2->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer3 = Customer::create([
            'name' => 'AAbou Hanna',
            'mobile' => '+61383391072',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Melbourne',
            'address' => 'Shop 18/22 Hollywood Dr',
            "customer_id" => $customer3->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer4 = Customer::create([
            'name' => 'ZAD Pizza & Kebab Resturant',
            'mobile' => '+61383742555',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Craigieburn',
            'address' => 'Shop 11-12/281 Marathon Blvd',
            "customer_id" => $customer4->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer5 = Customer::create([
            'name' => 'Coburg Pizza',
            'mobile' => '+61393837555',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Coburg',
            'address' => '254 Sydney Rd',
            "customer_id" => $customer5->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer6 = Customer::create([
            'name' => 'Baghdad Cafe & Restaurant',
            'mobile' => '+61423446190',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3047',
            'city' => 'Broadmeadows',
            'address' => '29A The Gateway',
            "customer_id" => $customer6->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer7 = Customer::create([
            'name' => 'Samoon Bakery and Kebab',
            'mobile' => '+61373794099',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Craigieburn',
            'address' => 'Shop 7/38 Craigieburn Rd',
            "customer_id" => $customer7->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer8 = Customer::create([
            'name' => 'bamboo-Resturant',
            'mobile' => '+610396621565',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '3000',
            'city' => 'Melbourne',
            'address' => 'Melbourne Victoria 3000',
            "customer_id" => $customer8->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer9 = Customer::create([
            'name' => 'Dinar Resturant',
            'mobile' => '+618351 9568',
            "created_at" => now(),
            "updated_at" => now()
        ]);
        Address::create([
            'state' => 'VIC',
            'post_code' => '8351',
            'city' => 'Craigieburn',
            'address' => '1/1-9 Mareeba Way',
            "customer_id" => $customer9->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer10 = Customer::create([
            'name' => 'Stuffed Lamb Resturant',
            'mobile' => '+61394694040',
            "created_at" => now(),
            "updated_at" => now()
        ]);

        Address::create([
            'state' => 'VIC',
            'post_code' => '3073',
            'city' => 'Reservoir',
            'address' => '210 Broadway',
            "customer_id" => $customer10->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer11 = Customer::create([
            'name' => 'Aston Falafel',
            'mobile' => '+61370677771',
            "created_at" => now(),
            "updated_at" => now()
        ]);

        Address::create([
            'state' => 'VIC',
            'post_code' => '3064',
            'city' => 'Craigieburn',
            'address' => '176 Elevation Bvd',
            "customer_id" => $customer11->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer12 = Customer::create([
            'name' => 'lebanese Bakery',
            'mobile' => '+610394652335',
            "created_at" => now(),
            "updated_at" => now()
        ]);

        Address::create([
            'state' => 'VIC',
            'post_code' => '3075',
            'city' => 'Lalor',
            'address' => '348 Station St',
            "customer_id" => $customer12->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $this->command->getOutput()->progressAdvance();
        $customer13 = Customer::create([
            'name' => 'World of Kaos',
            'mobile' => '+61393037111',
            "created_at" => now(),
            "updated_at" => now()
        ]);

        Address::create([
            'state' => 'VIC',
            'post_code' => '3048',
            'city' => 'Coolaroo',
            'address' => '3/2-10 Reservoir Dr',
            "customer_id" => $customer13->id,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $this->command->getOutput()->progressFinish();
    }
}
