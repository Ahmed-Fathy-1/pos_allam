<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    final public function orders(){
        return $this->hasMany(Order::class);
    }

   final public function addresses(){
        return $this->hasMany(Address::class,'customer_id');
    }
    public function prices(){
        return $this->hasMany(CustomerPrice::class);
    }

   final public function payTransfers(): HasMany
   {
        return $this->hasMany(PaymentTransfer::class);
    }
}
