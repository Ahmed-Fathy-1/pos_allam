<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
      return  $this->belongsTo(User::class);
    }
    public function cartDetails(){
        return $this->hasMany(CartDetails::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
}
