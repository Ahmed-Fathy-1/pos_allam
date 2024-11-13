<?php

namespace App\Http\Controllers\Api\SuperAdmin\Features;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\SuperAdmin\Features\FeatureRequest;
use App\Http\Resources\Api\Features\FeatureResource;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Features\Feature;

class FeatureController extends Controller
{

    use UploadFileTrait;

    protected $filePath = 'images/features';

    public function index()
    {
        $features = Feature::get();
        return ResponseHelper::sendResponseSuccess([
            'features' => FeatureResource::collection($features),
        ]);
    }

}
