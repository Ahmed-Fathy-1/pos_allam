<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransfer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    final public function ordersTansfer(){
        return $this->belongsToMany(Order::class, 'order_payment_transfer', 'payment_transfer_id', 'order_id')->withTimestamps();
    }

    final public function customer(){
        return $this->belongsTo(Customer::class);
    }


}
