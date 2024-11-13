<?php

namespace App\Models\SuperAdmin;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Utils\UploadFileTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory, UploadFileTrait , SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'image',
        'name_en',
        'name_ar'
    ] ;

    protected $append = ['image_with_full_path'];

    protected $imageFolder = 'images/paymentMethods';


    protected function imageWithFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFileWithFullPath($this->image, $this->imageFolder),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
