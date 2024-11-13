<?php

namespace Database\Seeders\landlord;


use App\Models\SuperAdmin\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PaymentMethod::insert([
            [
                'name_ar' => 'Stripe',
                'name_en' => 'بوابة دفع الكترونية Stripe',
                'image' => null,
                'status' => '1',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name_ar' => 'paymob',
                'name_en' => 'بوابة دفع الكترونية paymob',
                'image' => null,
                'status' => '0',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name_ar' => 'Paypal',
                'name_en' => 'بوابة دفع الكترونية Paypal',
                'image' => null,
                'status' => '0',
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'name_ar' => 'vodafone cash',
                'name_en' => 'بوابة دفع الكترونية vodafone cash',
                'image' => null,
                'status' => '0',
                'user_id' => 1,
                'created_at' => now()
            ],
        ]);


    }
}
