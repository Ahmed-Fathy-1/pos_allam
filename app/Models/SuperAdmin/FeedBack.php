<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedBack extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'feedbacks';

    protected $fillable = ['name','email','content'];
}
