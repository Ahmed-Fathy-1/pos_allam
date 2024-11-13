<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function unitLogs(){
        return $this->hasMany(Unit::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function unitPrice(){
        return $this->hasMany(productPrice::class);
    }
}
