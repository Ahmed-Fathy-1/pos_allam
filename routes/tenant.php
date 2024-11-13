<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Log\LogController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UnitController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\CashierController;
use App\Http\Controllers\Api\Admin\InvoiceController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\DeliveryController;
use App\Http\Controllers\Api\Admin\EmployeeController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Api\Admin\CashierDateController;
use App\Http\Controllers\Api\Admin\MetaDashboardController;
use App\Http\Controllers\Api\Admin\Report\ReportController;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use App\Http\Controllers\Api\public\Data\PublicDataController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Api\Admin\Banner\BannerAdminController;
use App\Http\Controllers\Api\Admin\Report\GeneralPaymentController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('sitemap.xml',[PublicDataController::class,'sitemapXml']);

Route::group(['prefix' => 'admin'],function(){

    Route::group(['prefix' => 'auth'],function (){
        Route::get('/',[AdminLoginController::class,'getLogin'])->name('get-name');
        Route::post('admin-login',[AdminLoginController::class,'login'])->name('admin-login');
        Route::post('admin-logout',[AdminLoginController::class,'logout'])->name('admin-logout');
    });

    Route::middleware(['auth:web'])->group(function(){

        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        Route::group(['prefix' => 'profile'],function (){
            Route::get('/',[AdminLoginController::class,'profile'])->name('profile');
            Route::post('admin-update',[AdminLoginController::class,'updateProfile'])->name('admin-data-update');
            Route::get('admin-change-password',[AdminLoginController::class,'getPassword'])->name('admin-change-password');
            Route::put('admin-update-password',[AdminLoginController::class,'updatePassword'])->name('admin-update-password');
        });

        Route::resource('unit',UnitController::class);
        Route::group(['prefix' => "banners"],function(){
            Route::get('/',[BannerAdminController::class,'index'])->name('banner');
            Route::post('store',[BannerAdminController::class,'store'])->name('banner-store');
            Route::put('update',[BannerAdminController::class,'update'])->name('banner-update');
            Route::delete('delete/{id}',[BannerAdminController::class,'destroy'])->name('banner-destroy');
        });

        Route::group(['prefix' => "category"],function(){
            Route::get('/',[CategoryController::class,'index'])->name('category');
            Route::get('create',[CategoryController::class,'create'])->name('category-create');
            Route::post('store',[CategoryController::class,'store'])->name('category-store');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category-edit');
            Route::put('update/{id}',[CategoryController::class,'update'])->name('category-update');
            Route::delete('delete/{id}',[CategoryController::class,'destroy'])->name('category-delete');
        });

        //coupon
        Route::group(['prefix' => 'coupon'],function(){
            Route::get('/',[CouponController::class,'index'])->name('coupon');
            Route::post('store',[CouponController::class,'store'])->name('coupon-store');
            Route::put('update/{id}',[CouponController::class,'update'])->name('coupon-update');
            Route::delete('delete/{id}',[CouponController::class,'destroy'])->name('coupon-delete');
        });

        //product
        Route::group(['prefix' => 'products'],function(){
            Route::get('/',[ProductController::class,'index'])->name('products');
            Route::get('create',[ProductController::class,'create'])->name('product-create');
            Route::post('store',[ProductController::class,'store'])->name('product-store');
            Route::get('log/{id}',[ProductController::class,'show'])->name('product-show');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product-edit');
            Route::put('update/{id}',[ProductController::class,'update'])->name('product-update');
            Route::delete('delete/{id}',[ProductController::class,'destroy'])->name('product-delete');
        });

        Route::group(['group'=>'customer'],function(){
            Route::get('customers',[CustomerController::class,'index'])->name('all-customers');
            Route::put('update/{id}',[CustomerController::class,'update'])->name('update-user');
            Route::put('update-customer/{id}',[CustomerController::class,'updateCustomer'])->name('update-customer');

            Route::post('store',[CustomerController::class,'store'])->name('store-customer');

            Route::post('store-user',[CustomerController::class,'storeUser'])->name('store-user');
            Route::post('another-address/{id}',[CustomerController::class,'newAddress'])->name('another-customer-address');
            Route::delete('delete-customer/{id}',[CustomerController::class,'destroy'])->name('delete-customer');

            //profile
            Route::get('profile/{id}',[CustomerController::class,'profile'])->name('customer-profile');

           Route::post('customer/product/{id}',[CustomerController::class,'product'])->name('customer-product');

        });
        // cashier
        Route::group(['prefix' => "cashier"],function (){
           // Route::get('/',[CashierController::class,'index'])->name('cashier');
            Route::post('store',[CashierController::class,'store'])->name('cashier-store');
            Route::get('statement/{id}',[CashierController::class,'show'])->name('cashier-show');

            // edit cashier
            Route::get('edit/statement/{id}',[CashierController::class,'edit']);
            Route::put('update/statement/{id}',[CashierController::class,'update'])->name('cashier-updated');

            Route::delete('delete/{id}',[CashierController::class,'destroy'])->name('cashier-delete');

            //POS Cahier
            Route::get('new',[CashierController::class,'newIndex'])->name('newIndex');
            //Route::get('/{customer}',[CashierController::class,'customerProduct'])->name('cashier.customer.product');
            Route::post('add-cart',[CashierController::class,'addCart'])->name('cashier.add-cart');
            Route::get('product-show/{id}',[CashierController::class,'showProduct'])->name('cashier.show.product');
            Route::delete('product-delete',[CashierController::class,'deleteProduct'])->name('cashier.delete.product');

            // cashier data with ajax
            Route::get('customer-address/{id}',[CashierDateController::class,'address']);
            Route::get('product-unit/{id}',[CashierDateController::class,'unit']);
            //order Checkout
            Route::post('checkout',[CashierController::class,'checkout'])->name('cashier.checkout');
            Route::get('edit-invoice/{id}',[CashierController::class,'editInvoice'])->name('edit-invoice');
            Route::post('update-order',[CashierController::class,'updateOrder'])->name('update-order');
            Route::post('checkout-update/{id}',[CashierController::class,'confirmUpdate'])->name('confirm-update-checkout');
            Route::delete('delete-product-order',[CashierController::class,'deleteFromOrderDetails'])->name('delete-from-order-detail');

        });

        // orders
        Route::group(['prefix' => 'orders'],function(){
            Route::get('/',[OrderController::class,'index'])->name('orders');
            Route::put('update/{id}',[OrderController::class,'update'])->name('order-update');
            Route::put('update/status/{id}',[OrderController::class,'changeStatus'])->name('order-status');
            Route::put('update/patilly/paid/{id}',[OrderController::class,'partillyPaid'])->name('order-partilly-paid');
            Route::delete('delete/{id}',[OrderController::class,'destroy'])->name('order-delete');
        });

        // customers
        Route::group(['prefix' => 'statements'],function (){
            Route::get('/',[InvoiceController::class,'index'])->name('invoice');
            Route::get('{id}/{type}',[InvoiceController::class,'show'])->name('invoice-show');
            Route::get('/{id}',[InvoiceController::class,'pdf'])->name('invoice.pdf');
            Route::get('print/pdf/toprinter/{id}',[InvoiceController::class,'print'])->name('invoice.print');
            Route::get('statement/customer/{id}/{status?}/{date?}', [InvoiceController::class, 'invoices'])->name('invoices.customer.pdf');
            Route::get('statement/customer-print/{id}/{status?}', [InvoiceController::class, 'invoicesPrintWeak'])->name('invoices.customer.print-statement');
            Route::get('statement/filter-pdf/{id}',[InvoiceController::class,'statementPdfFilter'])->name('filter-statement-pdf');
            Route::get('statement/filter-print/{id}/{start_date}/{end_date}/{status?}',[InvoiceController::class,'statementPrintFilter'])->name('filter-statement-print');
        });

        //general payments
        Route::get('general-payments',[GeneralPaymentController::class,'index'])->name('general.payment');
        Route::post('pay-general-payment',[GeneralPaymentController::class,'store'])->name('pay.general.payment');
        Route::get('customer-total-due/{id}',[GeneralPaymentController::class,'customerTotalDue']); // ajax request
        Route::get('general-payments/{id}',[GeneralPaymentController::class,'show'])->name('show-general-payment');
        Route::get('payment-transfer/{id}',[GeneralPaymentController::class,'paymentPdf'])->name('payment.transfer.pdf');
        Route::get('payment-transfer-print/{id}',[GeneralPaymentController::class,'paymentPrint'])->name('payment.transfer.print');


        Route::group(['prefix' => "report"],function(){
            Route::get('/',[ReportController::class,'index'])->name('reports');
            Route::post('store',[ReportController::class,'store'])->name('report-store');
            Route::get('show/{id}/{status?}',[ReportController::class,'show'])->name('report-show');
            Route::delete('delete',[ReportController::class,'destroy'])->name('report-delete');
            Route::get('show/pdf/statement/{id}/{status?}',[ReportController::class,'pdfStatement'])->name('report.pdf');
        });


        Route::group(['prefix' => 'delivery'],function (){
            Route::get('/',[DeliveryController::class,'index'])->name('delivery');
            Route::post('deliver',[DeliveryController::class,'store'])->name('assign-delivery');
            Route::put('update/{id}',[DeliveryController::class,'update'])->name('update-delivery');

            Route::get('oldOrders',[DeliveryController::class,'oldOrders'])->name('delivery-old-orders');
        });

        Route::resource('employee',EmployeeController::class);
        Route::resource('role',RoleController::class);

        Route::group(['prefix' => 'logs'],function(){
            Route::get('/',[LogController::class,'logs'])->name('order.logs');
            Route::get('order-payment-transfer/{id}',[LogController::class,'paymentLogs'])->name('logs.order.payment');
        });

        Route::group(['prefix' => 'setting'],function(){
            Route::get('/',[SettingController::class,'index'])->name('setting');
            Route::put('update',[SettingController::class,'update'])->name('setting-update');
        });

        Route::group(['prefix' => "meta-tags"],function(){
            Route::post('home-meta',[MetaDashboardController::class,'update'])->name('meta-update');
            Route::put('meta-product-update/{id}',[MetaDashboardController::class,'metaProduct'])->name('update-meta-product');
            Route::put('meta-category-update/{id}',[MetaDashboardController::class,'metaCategory'])->name('update-meta-category');
        });


    });
});

});
