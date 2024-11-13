<?php

use App\Http\Controllers\SuperAdmin\AboutUS\AboutUsController;
use App\Http\Controllers\SuperAdmin\FAQs\FAQController;
use App\Http\Controllers\SuperAdmin\Features\FeatureController;
use App\Http\Controllers\SuperAdmin\Needs\MainNeedController;
use App\Http\Controllers\SuperAdmin\Needs\SubNeedsController;
use App\Http\Controllers\SuperAdmin\Payment\PaymentController;
use App\Http\Controllers\SuperAdmin\Technologies\TechnologyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\Auth\AuthController;
use App\Http\Controllers\SuperAdmin\Users\UserController;
use App\Http\Controllers\SuperAdmin\Domains\TenantController;
use App\Http\Controllers\SuperAdmin\Packages\PackageController;
use App\Http\Controllers\SuperAdmin\Settings\SettingController;
use App\Http\Controllers\SuperAdmin\PaymentMethods\PaymentMethodController;
use App\Http\Controllers\SuperAdmin\ContactUs\ContactUsController;
use App\Http\Controllers\SuperAdmin\FeedBacks\FeedBacksController;
use App\Http\Controllers\SuperAdmin\HomeCovers\HomeCoverController;
use App\Http\Controllers\SuperAdmin\Roles\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes
        Route::get('/', fn() => redirect()->route('homePage'));

        // Authentication Routes
        Route::get('/home', [HomeController::class, 'index'])->name('homePage');
        Route::get('login', [AuthController::class, 'loginPage'])->name('loginPage');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('forget-password', [AuthController::class, 'forgetPasswordPage'])->name('forgetPasswordPage');
        Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
        Route::post('check-code', [AuthController::class, 'checkCode'])->name('checkCode');

        Route::middleware(['auth'])->group(function () {

            // Profile Routes
            Route::get('profile', [AuthController::class, 'profile'])->name('profile_page');
            Route::put('profile-update', [AuthController::class, 'updateProfile'])->name('profile_update');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');

            // Resource Controllers
            Route::resources([
                'users' => UserController::class,
                'settings' => SettingController::class,
                'features' => FeatureController::class,
                'tenants' => TenantController::class,
                'payment-methods' => PaymentMethodController::class,
                'packages' => PackageController::class,
                'contact-us' => ContactUsController::class,
                'feedbacks' => FeedBacksController::class,
                'technologies' => TechnologyController::class,
                'faqs' => FAQController::class,
                'main_needs' => MainNeedController::class,
                'sub_needs' => SubNeedsController::class,
                'payments' => PaymentController::class,
                'roles' => RoleController::class,

            ]);

            // Custom Routes for Users
            Route::get('/trashed-users', [UserController::class, 'trashed'])->name('users.trashed');
            Route::put('/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
            Route::delete('/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');


            // Payment Methods Additional Routes
            Route::delete('/payment-methods/{id}/permdelete', [PaymentMethodController::class, 'forceDelete'])->name('payments.permdelete');
            Route::get('/payment-methods-deleted', [PaymentMethodController::class, 'trashedPaymethod'])->name('payments.trashedPaymethod');
            Route::get('/payment-methods/{id}/restore', [PaymentMethodController::class, 'restore'])->name('payments.restore');


            // packages
            Route::get('archived/packages', [PackageController::class, 'archivedPackages'])->name('packages.archived');
            Route::post('packages/{id}/restore', [PackageController::class, 'restore'])->name('packages.restore');
            Route::delete('packages/{id}/force-delete', [PackageController::class, 'forceDelete'])->name('packages.forceDelete');


            // contact us
            Route::get('/contact-us-deleted', [ContactUsController::class, 'trashed'])->name('contact-us.trashed');
            Route::get('/contact-us/{id}/restore', [ContactUsController::class, 'restore'])->name('contact-us.restore');
            Route::delete('/contact-us/{id}/force-delete', [ContactUsController::class, 'forceDelete'])->name('contact-us.forceDelete');


            // Feedbacks
            Route::delete('/feedbacks/{id}/permdelete', [FeedBacksController::class, 'forceDelete'])->name('feedbacks.permdelete');
            Route::get('/feedbacks-deleted', [FeedBacksController::class, 'trashedFeedbacks'])->name('feedbacks.trashedFeedbacks');
            Route::get('/feedbacks/{feedback}/restore', [FeedBacksController::class, 'restore'])->name('feedbacks.restore');


            // Technologies
            Route::delete('/technologies/{id}/permdelete', [TechnologyController::class, 'forceDelete'])->name('technologies.permdelete');
            Route::get('/technologies-deleted', [TechnologyController::class, 'trashedTechnologies'])->name('technologies.trashedTechnologies');
            Route::get('/technologies/{technology}/restore', [TechnologyController::class, 'restore'])->name('technologies.restore');


            // FAQs
            Route::delete('/faqs/{id}/permdelete', [FAQController::class, 'forceDelete'])->name('faqs.permdelete');
            Route::get('/faqs-deleted', [FAQController::class, 'trashedFaqs'])->name('faqs.trashedFaqs');
            Route::get('/faqs/{faq}/restore', [FAQController::class, 'restore'])->name('faqs.restore');


            // sub_needs
            Route::get('/sub_needs-deleted', [SubNeedsController::class, 'showDeleted'])->name('sub_needs.deleted');
            Route::post('/sub-needs/{id}/restore', [SubNeedsController::class, 'restore'])->name('sub_needs.restore');
            Route::delete('/sub-needs/{id}/forcedeleted', [SubNeedsController::class, 'forceDelete'])->name('sub_needs.forcedelete');


            // payments
            Route::get('/payments-deleted', [PaymentController::class, 'showDeleted'])->name('payments.deleted');
            Route::post('/sub-payments/{id}/restore', [PaymentController::class, 'restore'])->name('payments.retirieve');
            Route::delete('/payments/{id}/forcedeleted', [PaymentController::class, 'forceDelete'])->name('payments.forcedelete');


            // about-us
            Route::get('/about-us/{id}/edit', [AboutUsController::class, 'edit'])->name('about_us.edit');
            Route::put('/about-us/{id}/update', [AboutUsController::class, 'update'])->name('about_us.update');


            // Home Cover
            Route::get('homecover/{id}', [HomeCoverController::class, 'edit'])->name('home_cover');
            Route::put('homecover/{id}', [HomeCoverController::class, 'update'])->name('update_home_cover');
        });

    });
}
