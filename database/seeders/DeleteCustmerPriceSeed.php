<?php

namespace Database\Seeders;

use App\Models\CustomerPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeleteCustmerPriceSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerPrice::get()->map(function ($customer){
            $customer->delete();
        });
    }
}
