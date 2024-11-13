<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Utils\UploadFileTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Technology extends Model
{
    use HasFactory,SoftDeletes, UploadFileTrait;
    protected $guarded = ['id'];
    protected $appends = ['image_with_full_path'];
    protected $imageFolder = 'images/technologies';


    protected function imageWithFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFileWithFullPath($this->image, $this->imageFolder),
        );
    }
}
