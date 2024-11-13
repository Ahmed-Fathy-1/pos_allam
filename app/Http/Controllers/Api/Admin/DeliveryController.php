<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\deliveryStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliverrRequest;
use App\Http\Requests\Admin\DeliveryStatusRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->hasRole('delivery')){
            $orders = Order::where(function ($q){
                $q->where('delivery_id',auth()->user()->id)
                    ->where('delivery_status','!=',deliveryStatusEnum::Delivered->value);
            })->with('orderDetails')->get();
        }else{
            $orders = Order::where(function ($q){
                $q->where('delivery_status','!=',deliveryStatusEnum::Delivered->value);
            })->with('orderDetails')->get();
        }
        $users = User::whereRoleName('delivery')->get();
        return view('Admin.pages.delivery.index',compact('orders','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliverrRequest $request)
    {
        $order = Order::findOrFail($request->id);
        $order->updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'delivery_id' => $request->delivery_id
            ]
        );
        return redirect()->back()->with('success','order Assigned To Delivery');
    }

    /**
     * Display the specified resource.
     */
    public function oldOrders()
    {
        $orders = Order::with('orderDetails')->where(function ($q){
                            $q->where('delivery_id',auth()->user()->id)
                                ->where('delivery_status',deliveryStatusEnum::Delivered->value);
                         })->latest('id')->get();
        return view('Admin.pages.delivery.oldorders',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryStatusRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['delivery_status' => $request->delivery_status]);
        return redirect()->back()->with('success','Order Status Changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
