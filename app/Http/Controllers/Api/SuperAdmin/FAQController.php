<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\ApiResponseTrait;
use App\Models\SuperAdmin\FAQ;

class FAQController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $faqs = FAQ::all();
        return $this->successResponse($faqs, 'Feedbacks retrieved successfully');
    }
}
