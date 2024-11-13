<?php

namespace App\Models\SuperAdmin;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'] ;

    public function package()
    {
       return $this->belongsTo(Package::class , 'package_id');
    }

}
