<?php

namespace App\Console\Commands;

use App\Events\Notify\CouponNotificationEvent;
use App\Models\Coupon;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CouponCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'end Coupon Automatically When End date Is Ended ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $coupons = Coupon::whereDate('end_at','<',Carbon::now())->get();
        foreach ($coupons as $coupon){
            $coupon->delete();
        }
    }
}
