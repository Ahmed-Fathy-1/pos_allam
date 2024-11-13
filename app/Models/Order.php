<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];


    public function cashier(){
        return $this->belongsTo(User::class,'cashier_id','id');
    }
    public function delivery(){
        return $this->belongsTo(User::class, 'delivery_id', 'id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function customer(){
        return $this->belongsTo(Customer::class)->withDefault();
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function transfers(){
        return $this->hasMany(PaymentTransfer::class);
    }

    public function paymentTransfers()
    {
        return $this->belongsToMany(PaymentTransfer::class, 'order_payment_transfer', 'order_id', 'payment_transfer_id')
                ->withPivot('deserved_amount', 'amount_paid')
                ->withTimestamps();
    }

}
