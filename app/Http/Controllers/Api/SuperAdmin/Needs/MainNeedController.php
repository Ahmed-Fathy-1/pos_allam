<?php

namespace App\Http\Controllers\Api\SuperAdmin\Needs;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MainNeeds\MainNeedResource;
use App\Http\Traits\Utils\ApiResponseTrait;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Needes\MainNeed;
use Illuminate\Http\Request;

class MainNeedController extends Controller
{

    use UploadFileTrait, ApiResponseTrait;

    protected $filePath = 'images/needs';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainNeeds = MainNeed::first();
        return $this->successResponse(new MainNeedResource($mainNeeds), 'main_needs');
    }

}
