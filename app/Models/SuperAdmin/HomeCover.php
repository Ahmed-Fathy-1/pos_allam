<?php

namespace App\Models\SuperAdmin;

use App\Http\Traits\Utils\UploadFileTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCover extends Model
{
    use HasFactory, UploadFileTrait;
    protected $guarded = ['id'];
    protected $appends = ['image_with_full_path'];
    protected $imageFolder = 'images/homecover';


    protected function imageWithFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFileWithFullPath($this->image, $this->imageFolder),
        );
    }

}
