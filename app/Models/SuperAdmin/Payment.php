<?php

namespace App\Models\SuperAdmin;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'] ;

    final public function user(){
        return $this->belongsTo(User::class);
    }

    final public function package(){
        return $this->belongsTo(Package::class);
    }

}
