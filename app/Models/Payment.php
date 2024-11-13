<?php

namespace App\Models;

use App\Models\SuperAdmin\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];

    public function order(){
        return $this->belongsTo(Order::class);

    }
    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
