<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderObserve
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {


    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
