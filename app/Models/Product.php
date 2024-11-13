<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded =['id'];

    protected $casts = [
        'images' => 'array',
        'alts' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug_url' | 'new_redirection';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function prices(){
        return $this->hasMany(productPrice::class);
    }

    public function specialPrices(){
        return $this->hasMany(CustomerPrice::class);
    }


}
