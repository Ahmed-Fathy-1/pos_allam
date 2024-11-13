<?php

namespace App\Models\SuperAdmin\Needes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainNeed extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sub_needs()
    {
        return $this->hasMany(SubNeeds::class);
    }
}
