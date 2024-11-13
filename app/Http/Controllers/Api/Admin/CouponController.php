<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\Order\EnterCouponRequest;
use App\Http\Resources\Data\Checkout\CouponResorce;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::get();
        return view('Admin.pages.coupon.index',compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnterCouponRequest $request)
    {
        $coupon = Coupon::create($request->validated()+["user_id" => auth()->user()->id]);
         return  redirect()->back()->with('success','coupon Added Successfully');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(EnterCouponRequest $request, string $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->update($request->validated());
            return redirect()->back()->with('success','coupon Updated Successfully');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            return  ResponseHelper::sendResponseSuccess('Coupon Deleted Successfully');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }
}
