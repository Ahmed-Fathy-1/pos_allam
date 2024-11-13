<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AddSerialOrdersDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersGroupedByDate = DB::table('orders')
            ->select(DB::raw('id, date, ROW_NUMBER() OVER (PARTITION BY date ORDER BY id) as row_number'))
            ->get();

        foreach ($ordersGroupedByDate as $order) {
            // Construct the serial value
            $serial = $order->id . '-' . $order->date . '-' . $order->row_number;

            // Update the serial column
            DB::table('orders')
                ->where('id', $order->id)
                ->update(['serial' => $serial]);
        }
    }
}
