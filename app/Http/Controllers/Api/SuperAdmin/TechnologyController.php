<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Technologies\TechnologyRequest;
use App\Models\SuperAdmin\Technology;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Http\Traits\Utils\ApiResponseTrait;

class TechnologyController extends Controller
{
    use UploadFileTrait, ApiResponseTrait;

    protected $uploadPath = 'images/technologies';

    public function index()
    {
        $techs = Technology::all();
        return $this->successResponse($techs, 'Technologies retrieved successfully');
    }


}
