<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaymentTransfer extends Model
{
    use HasFactory;

    protected $table = 'order_payment_transfer';
    protected $guarded = ['id'];

    final public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    final public function Transfer()
    {
        return $this->belongsTo(PaymentTransfer::class, 'payment_transfer_id');
    }
}
