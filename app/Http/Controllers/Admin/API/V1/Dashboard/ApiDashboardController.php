<?php

namespace App\Http\Controllers\Admin\API\V1\Dashboard;

use App\Enums\deliveryStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = [
            'products' => Product::count(),
            "category" => Category::count(),
            "orders" => Order::whereHas('address')->count(),
            "users" => Customer::whereHas('addresses')->count()
        ];
        $paidOrders= Order::where('status',1)->count();
        $unPaidOrder= Order::where('status',0)->count();
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
        return ResponseHelper::jsonResponse([
            'count' =>$count,
            'pie_chart_orders' => [
                "series" => [$paidOrders,$unPaidOrder],
                "labels" => ['Paid Orders','UnPaid Orders']
                ],
            'stacked_column_charts_delivery_orders' =>[
                'series' => [
                    [
                        "name" => 'Total Orders',
                        'data' => $total_order,
                    ],
                    [
                        "name" => 'Order Pending',
                        'data' => $delivery_pending,
                    ],
                    [
                        "name" => 'Order InTransit',
                        'data' => $delivery_inTransit,
                    ],
                    [
                        "name" => 'Order Delivered',
                        'data' => $delivered,
                    ],
                ],
                "categories" => $dates

            ]
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
