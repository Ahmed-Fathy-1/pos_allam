<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\FeedbackRequest;
use App\Models\SuperAdmin\FeedBack;
use App\Http\Traits\Utils\ApiResponseTrait;

class FeedBacksController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $feedbacks = FeedBack::all();
        return $this->successResponse($feedbacks, 'Feedbacks retrieved successfully');
    }

}
