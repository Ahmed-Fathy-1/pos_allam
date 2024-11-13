<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\HomeCover;
use App\Http\Requests\SuperAdmin\HomeCovers\HomeCoverRequest;
use App\Http\Traits\Utils\ApiResponseTrait;

class HomeCoverController extends Controller
{
    use UploadFileTrait, ApiResponseTrait;

    protected $uploadPath = 'images/homecover';

    public function index()
    {
        $homecover = HomeCover::find(1);
        return $this->successResponse($homecover, 'Home cover retrieved successfully');
    }
}
