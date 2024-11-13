<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Packages\PackageRequest;
use App\Http\Traits\Utils\ApiResponseTrait;
use App\Models\SuperAdmin\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{

    use ApiResponseTrait;

    public function index(Request $request)
    {
        $packages = Package::with('packageDetails')->latest()->get();
        return $this->successResponse($packages, 'Package retrieved successfully.');
    }

    public function show($id)
    {
        $package = Package::with('packageDetails')->find($id);
        return $this->successResponse($package, 'Package retrieved successfully.');
    }

}
