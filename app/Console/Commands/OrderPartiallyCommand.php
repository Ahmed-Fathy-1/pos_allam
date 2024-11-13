<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\PaymentTransfer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OrderPartiallyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'modify:orderPartial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update balance customer depend on over payment ';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        DB::beginTransaction();
        try {
            Order::where('status',2)->where('amount_paid',0)->get()->map(function ($order){
                $order->update(['status' => 0,'remaining_amount' => 0,'payment_status' => null]);
                $order->transfers()->delete();
            });
            DB::commit();
            $this->info('solve order partially paid success');
        }catch (\Exception $ex){
            DB::rollBack();
            $this->info($ex->getMessage());
        }
    }
}
