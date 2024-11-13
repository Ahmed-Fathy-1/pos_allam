<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmountOrderDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::where('status',1)->get()->map(function ($order){
            $order->update(['amount_paid' =>$order->total]);
        });
    }
}
