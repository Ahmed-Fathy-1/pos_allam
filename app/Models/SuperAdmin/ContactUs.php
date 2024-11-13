<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'contact_us';



    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
