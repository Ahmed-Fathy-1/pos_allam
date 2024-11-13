<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Utils\UploadFileTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, UploadFileTrait, SoftDeletes;

    protected $guarded = [];
    protected $append = ['image_with_full_path', 'footer_image_with_full_path'];
    protected $imageFolder = 'images/settings';


    protected function imageWithFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFileWithFullPath($this->image, $this->imageFolder),
        );
    }
    protected function footerImageWithFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFileWithFullPath($this->footer_image, $this->imageFolder),
        );
    }

}
