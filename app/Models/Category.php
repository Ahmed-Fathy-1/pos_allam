<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'array',
        'alts' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug_url' | 'new_redirection';
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function meta(){
        return $this->hasOne(MetaSeo::class,'category_id');
    }


}
