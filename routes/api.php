<?php


use App\Http\Controllers\Api\SuperAdmin\aboutUs\AboutUsController;
use App\Http\Controllers\Api\SuperAdmin\FAQController;
use App\Http\Controllers\Api\SuperAdmin\Features\FeatureController;
use App\Http\Controllers\Api\SuperAdmin\FeedBacksController;
use App\Http\Controllers\Api\SuperAdmin\HomeCoverController;
use App\Http\Controllers\Api\SuperAdmin\Needs\MainNeedController;
use App\Http\Controllers\Api\SuperAdmin\Needs\SubNeedsController;
use App\Http\Controllers\Api\SuperAdmin\TechnologyController;
use App\Http\Controllers\Api\SuperAdmin\PaymentController;
use App\Http\Controllers\Api\SuperAdmin\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperAdmin\PackageController;
use App\Http\Controllers\Api\SuperAdmin\ContactUsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth for each sub-doman
Route::group(['prefix' => "auth"], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => "auth"], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });

    // Route::post('/pay-package', [PaymentController::class, 'payPackage']);
    Route::post('payment/initiate', [PaymentController::class, 'initiatePayment']);
    Route::post('payment/complete', [PaymentController::class, 'completePayment']);
    Route::post('payment/failure', [PaymentController::class, 'failPayment']);
});


Route::get('/homecovers', [HomeCoverController::class, 'index']);

Route::post('/contact-us', [ContactUsController::class, 'store']);

Route::get('/faqs', [FAQController::class, 'index']);

Route::get('/feedbacks', [FeedBacksController::class, 'index']);

Route::get('/technologies', [TechnologyController::class, 'index']);

Route::apiResource('packages', PackageController::class);

Route::apiResource('features', FeatureController::class);

Route::apiResource('main_needs', MainNeedController::class);

Route::apiResource('sub_needs', SubNeedsController::class);

Route::apiResource('about-us', AboutUsController::class)->only(['index', 'update']);
