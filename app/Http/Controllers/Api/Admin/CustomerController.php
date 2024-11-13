<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\CutomerProductRequest;
use App\Http\Requests\Admin\CustomerRequest;
use App\Http\Requests\Admin\User\CustomerUpdateRequest;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Requests\Api\checkout\StoreAddress;
use App\Http\Requests\Api\public\Auth\RegisterRequest;
use App\Models\Address;
use App\Models\Customer;
use App\Models\CustomerPrice;
use App\Models\Order;
use App\Models\PaymentTransfer;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use App\services\cashier\addressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::WhereNull('role_name')->latest('id')->get();
        $customers = Customer::whereHas('addresses')->latest('id')->get();

        return view('Admin.pages.customers.index',compact('customers','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request,addressService $service)
    {
        $customer =  Customer::create(['name' => $request->name,"mobile" => $request->mobile,'abn' => $request->abn]);
        $service->address($customer->id,$request->state,$request->city,$request->post_code,$request->address);
        return redirect()->back()->with('success','New Customer Added');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(RegisterRequest $request)
    {
        User::create($request->validated());
        return redirect()->back()->with('success','New Customer Added');
    }

    public function newAddress(StoreAddress $request,$id){
       if($request->type == "user"){
           $user = User::findOrFail($id);
           Address::create($request->validated()+['user_id' => $id]);
       }else{
           $customer = Customer::findOrFail($id);
           Address::create($request->validated()+['customer_id' => $id]);
       }
        return redirect()->route('all-customers')->with('success','New Address Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $mobile)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);
        $user->update($validated);
        return redirect()->route('all-customers')->with('success','Data Updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCustomer(CustomerUpdateRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $customer = Customer::findOrFail($id);
            $customer->update(['name' => $request->name,"mobile" => $request->mobile,'abn' => $request->abn]);
            $address = $customer->addresses()->latest('id')->first();
            $address->update(["state" => $request->state,"city" => $request->city,"post_code" => $request->post_code,'address' => $request->address]);
            DB::commit();
            return redirect()->route('all-customers')->with('success','Data Updated Successfully');
        }catch (\Exception $ex){
            DB::rollBack();
            return  redirect()->back()->withErrors($ex->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $orders = $customer->orders;
        if($orders->isNotEmpty()){
            return  redirect()->back()->withErrors('This Customers Have :'.$orders->count().' Orders Delete Orders First');
        }

        $customer->prices()->delete();
        // Delete associated addresses
        $customer->addresses()->delete();

        // Delete the customer
       // $customer->delete();
        return redirect()->back()->with('success','customer deleted Successfully');
    }

    final public function profile(Request $request,$id){
        $paginate = $request->number??10;
         $customer = Customer::with('prices')->findOrFail($id);
         $orders = Order::whereCustomerId($id)->with('orderDetails','cashier','address')->get();
         $units = Unit::get();
         $products = Product::whereNotIn('id',$customer->prices()->pluck('product_id'))->get();
         $transfers = PaymentTransfer::whereCustomerId($id)->latest('id')->paginate($paginate);
         // chart column for total on every month
        function formatNumbers(&$array) {
            foreach ($array as &$value) {
                $value = number_format($value, 2, '.', '');
            }
            unset($value); // Break the reference with the last element
        }
        $year = date('Y');
        $month = date('m');
        $dates = []; $total_orders = []; $orders_paid = []; $order_notPaid = []; $orders_remaining = [];
        for($i = 0; $i < 12; $i++){
            $dates[] = date('M Y', strtotime("$year-$month-01"));
            $total_orders[] =  Order::whereCustomerId($id)->where(function ($q) use ($year,$month){
                $q->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            })->sum('total');


            $orders_paid[] = Order::whereCustomerId($id)->where(function ($q) use ($year,$month){
                $q->where('status','!=',0)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            })->sum('amount_paid');

            $orders_remaining[] = Order::whereCustomerId($id)->where(function ($q) use ($year,$month){
                        $q->where('status','!=',0)
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month);
                    })->sum('remaining_amount');

            $order_notPaid[] = Order::whereCustomerId($id)->where(function ($q) use ($year,$month){
                $q->where('status',0)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            })->sum('total');

            $month--;
            if ($month == 0) {
                $month = 12;
                $year--;
            }
        }

        // Format numbers to two decimal places
        formatNumbers($total_orders);
        formatNumbers($orders_paid);
        formatNumbers($order_notPaid);
        formatNumbers($orders_remaining);

        return view('Admin.pages.customers.profile',
            [
                'customer' => $customer,
                'units' => $units,
                'orders' => $orders,
                'products' => $products,
                'transfers' => $transfers,
                "dated" => array_reverse($dates),
                "total_orders" => array_reverse($total_orders),
                "orders_paid" => array_reverse($orders_paid),
                "orders_remaining" => array_reverse($orders_remaining),
                "order_notPaid" => array_reverse($order_notPaid),
                'paginate' => $paginate
            ]);
    }

    final public function product(CutomerProductRequest $request ,$id){
        $validated = $request->validated();
        $customer = Customer::with('prices')->findOrFail($id);
        $customer->prices()->updateOrCreate(
            [
                "product_id" =>  $validated['product_id'],
                "unit_id" =>  $validated['unit_id'],
                'customer_id' => $id
            ],
            [
                "product_id" =>  $validated['product_id'],
                "unit_id" =>  $validated['unit_id'],
                "price" => $validated['price'],
                "user_id" => auth()->user()->id
            ]
        );
        return redirect()->back()->with(['success','Date Updated  Successfully']);
    }
}
