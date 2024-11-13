<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productPrice extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
