<?php

namespace App\Models\SuperAdmin;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'] ;

    public function packageDetails()
    {
        return $this->hasOne(PackageDetails::class , 'package_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
