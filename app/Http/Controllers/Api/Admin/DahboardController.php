<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\deliveryStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Admin\Report\OrderReportResource;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DahboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = [
          'products' => Product::count(),
          "category" => Category::count(),
          "Orders" => Order::count(),
          "users" => User::whereNull('role_name')->count()
        ];

        // charts last 8 days
        $currentDate = Carbon::tomorrow(); $onlineOrders = [];$cashierOrder = [];
        $date = []; $total_order = [];$delivery_inTransit = []; $delivered = [];
        for ($i = 7 ; $i >= 0 ; $i--){
            $startDate = $currentDate->subDays(1)->startOfDay();
            $endDate = $startDate->copy()->endOfDay();
            $date[] = $startDate->format('d M');
            //pie chart
            $onlineOrders [] = Order::whereNull('cashier_id')
                ->whereBetween('created_at', [$startDate, $endDate])->count();
           $cashierOrder [] = Order::whereNotNull('cashier_id')
               ->whereBetween('created_at', [$startDate, $endDate])->count();

            //column charts delivery orders
            $total_order [] = Order::whereBetween('created_at', [$startDate, $endDate])->count();
            $delivery_pending [] = Order::whereDeliveryStatus(deliveryStatusEnum::Pending->value)
                                    ->whereBetween('created_at', [$startDate, $endDate])->count();
            $delivery_inTransit [] = Order::whereDeliveryStatus(deliveryStatusEnum::InTransit->value)
                                      ->whereBetween('created_at', [$startDate, $endDate])->count();
            $delivered [] =  Order::whereDeliveryStatus(deliveryStatusEnum::Delivered->value)
                                ->whereBetween('created_at', [$startDate, $endDate])->count();
        }

        $orders = Order::with('orderDetails')->latest('id')->take(10)->get();

        return ResponseHelper::sendResponseSuccess([
           'count' => $count,
            'pie_chart' => [
                    'online_order' => array_sum($onlineOrders),
                    "cashier_order" => array_sum($cashierOrder)
                 ],
           'column_chart' => [
               "total_order" => array_reverse($total_order),
               'delivery_pending' => array_reverse($delivery_pending),
               "delivery_inTransit" => array_reverse($delivery_inTransit),
               "delivered" => array_reverse($delivered),
               "date" => array_reverse($date)
           ],
           'latest_orders' =>  OrderReportResource::collection($orders)
        ]);

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
