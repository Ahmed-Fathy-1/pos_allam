<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponLogs extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
}
