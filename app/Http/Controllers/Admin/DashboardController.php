<?php

namespace App\Http\Controllers\Admin;

use App\Enums\deliveryStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\MetaSeo;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = [
            'products' => Product::count(),
            "category" => Category::count(),
            "orders" => Order::count(),
            "users" => Customer::whereHas('addresses')->count()
        ];
        $paidOrders= Order::where('status',1)->where('remaining_amount',0)->count();
        $unPaidOrder= Order::where('status',0)->count();
        $orderRemain = Order::where('status',2)->count();
        // charts last 8 days
        $dates = []; $total_order = [];$delivery_inTransit = []; $delivered = [];$delivery_pending = [];
        $lastDates = Order::select(DB::raw('DATE(created_at) as date'))
                                   ->groupBy('date')
                                   ->orderBy('date', 'desc')
                                   ->take(8)
                                   ->pluck('date');
        for ($i = count($lastDates) - 1; $i >=0 ; $i--){
            $lastDate = $lastDates[$i];
            $startDate = Carbon::parse($lastDate)->startOfDay();
            $endDate = Carbon::parse($lastDate)->endOfDay();
            $date = $startDate->format('d M');
            //column charts delivery orders
            $total_order [] = Order::whereBetween('created_at', [$startDate, $endDate])->count();
            $delivery_pending [] = Order::whereDeliveryStatus(deliveryStatusEnum::Pending->value)
                                ->whereBetween('created_at', [$startDate, $endDate])->count();
            $delivery_inTransit [] = Order::whereDeliveryStatus(deliveryStatusEnum::InTransit->value)
                                     ->whereBetween('created_at', [$startDate, $endDate])->count();
            $delivered [] =  Order::whereDeliveryStatus(deliveryStatusEnum::Delivered->value)
                            ->whereBetween('created_at', [$startDate, $endDate])->count();
            $dates [] = $date;
        }
         $orders = Order::with('orderDetails')->latest('id')->get();
         $users = User::whereRoleName('delivery')->get();
      /*  $total_order = $total_order;
        $delivery_pending = ($delivery_pending);
        $delivery_inTransit = array_reverse($delivery_inTransit);
        $delivered = array_reverse($delivered);
        $dates = array_reverse($dates);*/


        return view('Admin.pages.index',[
            'count' => $count,
            'paidOrders' => $paidOrders,
            'unPaidOrder' => $unPaidOrder,
            'orderRemain' => $orderRemain,
            "total_order" => $total_order,
            'delivery_pending' =>$delivery_pending,
            "delivery_inTransit" => $delivery_inTransit,
            "delivered" => $delivered,
            "date" => $dates,
            "orders" => $orders,
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
