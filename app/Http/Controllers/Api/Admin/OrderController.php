<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\Order\ChangeStatusRequest;
use App\Http\Requests\Admin\Order\UpdateStatusOrderRequest;
use App\Http\Resources\Admin\Report\OrderReportResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentTransfer;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->number??10;
        $customerId = null;
            if(isset($request->customer_id) && $request->customer_id !=null){
                $customerId = $request->customer_id;
            }
            $count = [
                "total_revenue" => Order::when(isset($customerId) && $customerId !=null,function ($q) use($customerId){
                                    $q->whereCustomerId($customerId);
                                     })->sum('total'),
                'total_orders' => Order::when(isset($customerId) && $customerId !=null,function ($q) use($customerId){
                                        $q->whereCustomerId($customerId);
                                    })->count(),
                'cashiers_orders' => Order::when(isset($customerId) && $customerId !=null,function ($q) use($customerId){
                                        $q->whereCustomerId($customerId);
                                    })->whereNotNull('cashier_id')->count(),
                'online_orders' => Order::when(isset($customerId) && $customerId !=null,function ($q) use($customerId){
                                        $q->whereCustomerId($customerId);
                                    })->whereNull('cashier_id')->count()
            ];
             $year = date('Y');
              $month = date('m');
            $date = [];$onlineOrders = []; $cashierOrders =[]; $total_revenue = [];
            $online_revenue = []; $cashier_revenue = [];


        for($i = 0; $i < 12; $i++){
            $date[] = date('M Y', strtotime("$year-$month-01"));

            $onlineOrders [] = Order::when(isset($customerId) && $customerId != null, function ($query) use ($customerId) {
                $query->whereCustomerId($customerId);
            })->whereNull('cashier_id')
                   ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)->count();
            $cashierOrders [] = Order::when(isset($customerId) && $customerId != null, function ($query) use ($customerId) {
                $query->whereCustomerId($customerId);
            })-> whereNotNull('cashier_id')
                     ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)->count();
            //column charts
            $total_revenue [] = Order::when(isset($customerId) && $customerId != null, function ($query) use ($customerId) {
                $query->whereCustomerId($customerId);
            })     ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)->sum('total');
            $online_revenue [] = Order::when(isset($customerId) && $customerId != null, function ($query) use ($customerId) {
                    $query->whereCustomerId($customerId);
                })-> whereNull('cashier_id') ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->sum('total')??0;
            $cashier_revenue [] =  Order::when(isset($customerId) && $customerId != null, function ($query) use ($customerId) {
                    $query->whereCustomerId($customerId);
                })-> whereNotNull('cashier_id')->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->sum('total')??0;

            $month--;
            if ($month == 0) {
                $month = 12;
                $year--;
            }
        }

           $precision = 2;
            $total_revenue = collect($total_revenue)->map(function ($total_revenue) use ($precision) {
                return round($total_revenue, $precision);
            })->toArray();
            $online_revenue = collect($online_revenue)->map(function ($online_revenue) use ($precision) {
                    return round($online_revenue, $precision);
                })->toArray();
            $cashier_revenue = collect($cashier_revenue)->map(function ($cashier_revenue) use ($precision) {
                return round($cashier_revenue, $precision);
            })->toArray();

            $orders = Order::with('orderDetails')->withTrashed()->when(isset($customerId) && $customerId !=null,function ($q) use($customerId){
                             $q->whereCustomerId($customerId);
                     })->latest('id')->paginate($paginate);

           // $users = User::whereRoleName('delivery')->get();
            $customers = Customer::whereHas('addresses')->get();
            return view('Admin.pages.orders.index',[
                'count' => $count,
                'online_orders' => array_reverse($onlineOrders),
                "cashier_orders" => array_reverse($cashierOrders),
                'date' => array_reverse($date),
                "total_revenue" => array_reverse($total_revenue),
                "online_revenue" => array_reverse($online_revenue),
                "cashier_revenue" => array_reverse($cashier_revenue),
                'orders' => $orders,
                "customerId" => $customerId,
                "customers" => $customers,
                'paginate' => $paginate
                //'users' => $users
            ]);
    }

    /**
     * Display the specified pdf from Storage.
     */
    public function pdf()
    {

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
    public function update(UpdateStatusOrderRequest $request, string $id)
    {
        $data = $request->validated();
        $order = Order::findOrFail($id);
        if($data['paid_at'] == null){
            $data['paid_at'] = Carbon::now();
        }
        if($data['amount_paid'] < $order->total){
            $data['status'] = 2;
        }
        $data['remaining_amount'] = $order->total - $data['amount_paid'];
        $order->update($data);
        $order->refresh();
        $generalPayment =  PaymentTransfer::create([
            'amount_paid' => $data['amount_paid'],
            'total_due' => $order->total,
            'remaining' => $order->total -  $data['amount_paid'],
            'payment_type' => $order->payment_status,
            'customer_id' =>$order->customer_id??null ,
            'order_id' => $id
        ]);
        $deserved_amount = $order->total;
        $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $deserved_amount,'amount_paid' => $data['amount_paid'] ]);
        return redirect()->back()->with('success','Order Status Updated Successfully');
    }

    public function partillyPaid(UpdateStatusOrderRequest $request, string $id){

        $data = $request->validated();
        $order = Order::findOrFail($id);
      if(isset($data['status']) && $data['status'] == 0){
          $data['payment_status'] = null;
          $data['amount_paid'] = 0;
          $data['remaining_amount'] = 0;
          $data['paid_at'] = null;
          $transfers = PaymentTransfer::whereOrderId($order->id)->get();
          if($transfers){
              foreach ($transfers as $transfer) {
                  $transfer->delete();
              }
          }
      }else{
          if($data['paid_at'] == null){
              $data['paid_at'] = Carbon::now();
          }
          $generalPayment =   PaymentTransfer::create([
                      'amount_paid' => $data['amount_paid'],
                      'total_due' => $order->remaining_amount ,
                      'remaining' => $order->total -  ($order->amount_paid + $data['amount_paid']),
                      'payment_type' => $data['payment_status'],
                      'customer_id' =>$order->customer_id??null ,
                      'order_id' => $id
                  ]);
          $deserved_amount = $order->remaining_amount;
          $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $deserved_amount ,'amount_paid' =>$data['amount_paid'] ]);
          $data['amount_paid'] = $order->amount_paid + $data['amount_paid'];

          $data['remaining_amount'] = $order->total - $data['amount_paid'];
          if($data['remaining_amount'] > 0){
              $data['status'] = 2;
          }else{
              $data['status'] = 1;
          }

      }
        $order->update($data);
        return redirect()->back()->with('success','Order Status Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->transfers()->delete();
        $order->orderDetails()->delete();
        $order->delete();
        return redirect()->back()->with('success','order Deleted Successfully');
    }

    public function changeStatus(ChangeStatusRequest $request, string $id){
        $order = Order::findOrfail($id);
        $data = $request->validated();
          if(isset($data['status'])){
              $data['payment_status'] = null;
              $data['amount_paid'] = 0;
              $data['remaining_amount'] = 0;
              $data['paid_at'] = null;
              $transfers = PaymentTransfer::whereOrderId($order->id)->get();
              if($transfers){
                  foreach ($transfers as $transfer) {
                      $transfer->delete();
                  }
              }
          }else{
              $generalPayment =  PaymentTransfer::create([
                  'amount_paid' => $data['amount_paid'],
                  'total_due' => $order->remaining_amount ,
                  'remaining' => $order->total -  ($order->amount_paid + $data['amount_paid']),
                  'payment_type' => $data['payment_status'],
                  'customer_id' =>$order->customer_id??null ,
                  'order_id' => $id
              ]);
              $deserved_amount = $order->remaining_amount;
              $generalPayment->ordersTansfer()->attach($order->id,['deserved_amount' => $deserved_amount,'amount_paid' => $data['amount_paid']]);

              $data['amount_paid'] = $order->amount_paid + $data['amount_paid'];
              $data['remaining_amount'] = $order->total - $data['amount_paid'];
          }

        $order->update($data);
        return redirect()->back()->with('success','Order Status Updated Successfully');
    }

}
