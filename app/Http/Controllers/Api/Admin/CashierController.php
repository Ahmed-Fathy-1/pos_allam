<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\deliveryStatusEnum;
use App\Enums\paymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\Cart\CahierCartRequest;
use App\Http\Requests\Admin\Order\CartOrderRequest;
use App\Http\Requests\Admin\Order\CashierRequest;
use App\Http\Requests\Admin\Order\UpdateinvoiceRequest;
use App\Http\Requests\Api\cart\CartDeleteRequest;
use App\Http\Resources\Admin\Orders\Cashier\OrderResource;
use App\Http\Resources\Data\Cart\CartResource;
use App\Mail\InvoiceMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Log;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentTransfer;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\User;
use App\services\cashier\cartServices;
use App\services\cashier\CashierService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use Stripe\Util\Set;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use function Laravel\Prompts\select;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* old Cashier Function */
    public function index()
    {
        $categories = Category::get();
        $units = Unit::get();
        $products = Product::select('id','name')->whereStatus(true)->get();
        $recipients = DB::table('customers')->select('name', 'mobile');
        $onlineUsers = DB::table('users')
                        ->whereNull('role_name')
                        ->whereNotExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('customers')
                                ->whereRaw('customers.mobile = users.mobile');
                        })->whereExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('addresses')
                                 ->whereRaw('addresses.user_id = users.id');
                        })->select('name', 'mobile');
        $customers = $recipients->union($onlineUsers)->get();
        $users = User::whereRoleName('delivery')->get();
       return view('Admin.pages.cashier.index',[
           'categories' => $categories,
           "units" => $units,
           "products" => $products,
           'users' => $users,
           "customers" => $customers
       ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CashierRequest $request,CashierService $service)
    {

        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $shippingValue = Setting::where('key', 'shipping')->first();
            if(isset($validated['delivery_id'])){
                if($shippingValue->value !=null){
                    $delivery =  $shippingValue->value ;
                }
            }

            $user = $service->customer($validated['customer_id']);
            $name =$user->name ; $mobile = $user->mobil; $abn = $user->abn ?? "personal";
            $order = Order::create(
                [
                    'address_id' => $validated['address_id']??null,
                    "cashier_id" => auth()->user()->id,
                    "delivery_id" => $validated['delivery_id']??null,
                    "mobile" => $user->mobile,
                    'shipping' => $delivery??0
                ]);
          $service->orderDetails($order->id, $validated['orders']);
          $service->updateOrder($order->load('orderDetails'));

          if(isset($validated['address_id'])){
              $address =  $order->address;
              $recipentAddress = $address->address .", ". $address->city .", ". $address->state .", ". $address->post_code;
          }else{
              $recipentAddress = "Not Selected";
          }

           $client = new Party([
                'name'          => auth()->user()->name . " (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          => $name . " (" .$mobile . " )" ,
                'address'       => $recipentAddress ,
                'phone'         => $abn,
                'custom_fields' => [
                    'order number' => $order->id,
                ],
            ]);
            $items = [];
            foreach ( $order->orderDetails as $orderInvoce ){
                $items [] =
                    InvoiceItem::make($orderInvoce->product->name)
                        ->description($orderInvoce->unit->name)
                        ->pricePerUnit($orderInvoce->price)
                        ->quantity($orderInvoce->quantity)
                        ->discount($orderInvoce->discount)
                        ->tax($orderInvoce->gst);
            }
            $notes = [
//            'we added ' . $tax . ' % tax on orders Total',
            ];

            $notes = implode("<br>", $notes);
            $invoice = Invoice::make('Butcher')
                // ->sequence($order->total)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->shipping($delivery??0)
                ->dateFormat('s:m:h m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('ِ‘]')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($order->id. '_invoice')
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('assets/dashboard/logo.png'))
                ->save('invoices');
            DB::commit();
           return  redirect()->route('cashier-show')->with('success','Order Created Successfully');
        }catch (Exception $ex){
            DB::rollBack();
            return  redirect()->back()->withErrors($ex->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Order::where('id',$id)->with('orderDetails','cashier','address')->first();
        return view('Admin.pages.cashier.show', ['invoice' => $invoice]);
//        $units = Unit::get();
//        $products = Product::select('id','name')->get();
//        $customers = Customer::latest('id')->get();
//        $users = User::whereRoleName('delivery')->get();
//        $order = Order::with('orderDetails')->whereCashierId(auth()->user()->id)->latest('id')->first();
//        return view('Admin.pages.cashier.show',[
//            'units' => $units,
//            'products' =>$products,
//            'customers' =>$customers,
//            'users' =>$users,
//            'order' =>$order,
//        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($id){
        $order = Order::findOrFail($id);
        return view('Admin.pages.cashier.edit',compact('order'));
    }
    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->orderDetails()->delete();
        $order->delete();
        return redirect()->route('newIndex')->with('success','Order Deleted Successfully');
    }

    /* POS [ new Cashier View ]  */
    public function newIndex(Request $request ,CashierService $service){
        $customer = null;
        $addresses = null;
        $mobile = null;
        $products = [];

        if(isset($request->customer) && $request->customer != null){
            $data = $service->customer($request->customer);
             $customer = $data->id;
            $mobile = $data;
            $addresses = $service->address($request->customer);
            $products = $service->recommendation($request->customer);
        }
        $categories = Category::whereHas('products')->with(['products'=> function ($q) use($customer){
                            $q->when($customer != null ,function ($query) use ($customer){
                                $query->with(['specialPrices'=> function ($query)use ($customer){
                                    $query->where('customer_id',$customer);
                                }]);
                            });
                      }])->get();
        $customers = $service->allCustomers();
        $deliveries = $service->userDelivery();
        return view('Admin.pages.cashier.new_index',
        [
            "categories" => $categories,
            "customers" => $customers,
            "addresses" => $addresses,
            "deliveries" => $deliveries,
            "products" => $products,
            "mobile" => $mobile

        ]);
    }


    /* cart functions */
    public function addCart(CahierCartRequest $request,cartServices $services){
        $data =  $services->addCart($request->validated());
        return ResponseHelper::sendResponseSuccess(new CartResource($data));
    }

    public function showProduct($id){
        $product = Product::findOrFail($id);
        return $product;
    }

    public function deleteProduct(Request $request){
        $cart = Cart::where('user_id', auth()->id())->with('cartDetails')->first();
        if(!$cart){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'No Products yet on cart');
        }
        $cartDetail = $cart->cartDetails()->where('id',$request->cart_detail_id)->first();
        if(!$cartDetail){
            return  ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'This product or Unit not exists');
        }
        $cartDetail->delete();
        $count = $cart->cartDetails()->count();
        if($count == 0){
            $cart->delete();
        }else{
            $cart->update(['total' =>$cart->cartDetails()->sum('sub_total') ]);
            $cart->refresh();
        }
        return true;
    }

    /* make checkout */
    public function checkout(CartOrderRequest $request,CashierService $service){
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $cart = Cart::where('user_id', auth()->id())->with('cartDetails')->first();
            $shippingValue = Setting::where('key', 'shipping')->first();
            if (isset($validated['delivery_id'])) {
                if ($shippingValue->value != null) {
                    $delivery = $shippingValue->value;
                }
            }
            $total = $cart->total + ($delivery ?? 0);
            if(isset($validated['customer_id']) && $validated['customer_id'] !="null"){
                $user = $service->customer($validated['customer_id']);
                    // check balance customer
                $balance = $user->balance;
                if ($balance > 0){
                  $serveBalance =  $service->balance($balance,$total);
                  $user->update(['balance' => $user->balance - $serveBalance['order']['amount_paid']]);
                  $user->refresh();
                }
            }
            $order = Order::create([
                "mobile" => $user->mobile??null,
                'customer_id' => $user->id??null,
                'shipping' => $delivery ?? 0,
                'address_id' => $validated['address_id'] ?? null,
                "delivery_status" => isset($validated['delivery_id'])? deliveryStatusEnum::Pending->value : deliveryStatusEnum::Delivered->value,
                "delivery_id" => $validated['delivery_id'] ?? null,
                'payment_method' => paymentMethodEnum::Cash->value,
                "total_discount" => $cart->CartDetails()->sum('total_discount'),
                "total_gst" => $cart->CartDetails()->sum('gst'),
                "total" => $total,
                'status' => 1,
                'payment_status' => isset($serveBalance['order']['payment_type'])?'3':null,
                'paid_at' => $serveBalance['order']['paid_at']??null,
                'amount_paid' => $serveBalance['order']['amount_paid']??0,
                'remaining_amount' => $serveBalance['order']['remaining_amount']??0,
                "cashier_id" => auth()->user()->id,
                "created_at" => $validated['created_at']??Carbon::now(),
                "updated_at" => $validated['created_at']??Carbon::now(),
            ]);
            //order Details save
            $service->orderDetailsCart($order->id);
            $serial = $order->id."-".\Carbon\Carbon::parse($order->created_at)->format('ymd').'-'.sprintf('%03d', \App\Models\Order::whereDate('created_at', $order->created_at)->count());
            $order->update(['serial' => $serial]);
            $order->refresh();
            // store log
            $service->log($order->id,'create Invoice');
            if(isset($serveBalance)){
                $serveBalance['pay']['customer_id'] = $order->customer_id;
                $serveBalance['pay']['order_id'] = $order->id;
                $service->logPayment($serveBalance);
            }
            DB::commit();
            return  redirect()->route('cashier-show',$order->id)->with('success','Order Created Successfully');
        }catch (Exception $ex){
            DB::rollBack();
            return  redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function editInvoice(Request $request , $id,CashierService $service){
       $order = Order::whereId($id)->with('orderDetails','address')->firstOrFail();
        $customer = null;
        $addresses = null;
        $mobile = null;
        $products = [];

        if( $order->address_id != null){
            $data = $service->customer($order->customer_id);
            $customer = $data->id;
            $mobile = $data;
            $addresses = $service->address($order->customer_id);
            $products = $service->recommendation($order->customer_id);
        }
        $categories = Category::whereHas('products')->with(['products'=> function ($q) use($customer){
            $q->when($customer != null ,function ($query) use ($customer){
                $query->with(['specialPrices'=> function ($query)use ($customer){
                    $query->where('customer_id',$customer);
                }]);
            });
        }])->get();
        $customers = $service->allCustomers();
        $deliveries = $service->userDelivery();
        return view('Admin.pages.cashier.new_edit',
            [
                "order" => $order,
                "categories" => $categories,
                "customers" => $customers,
                "addresses" => $addresses,
                "deliveries" => $deliveries,
                "products" => $products,
                "mobile" => $mobile

        ]);
    }

    public function updateOrder(UpdateinvoiceRequest $request,cartServices $services){
         return $services->updateorder($request->validated());
    }

    final public function deleteFromOrderDetails(Request $request){
        $orderDetail = OrderDetail::where('id',$request->order_detail_id)->first();
        $order = Order::whereId($orderDetail->order_id)->first();
        if(!$orderDetail){
            return  ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'This product or Unit not exists');
        }
        $orderDetail->delete();
        $count = $order->orderDetails()->count();
        if($count == 0){
            $order->delete();
        }else{
            $order->update(['total' =>$order->orderDetails()->sum('sub_total') ]);
            $order->refresh();
        }
        return true;
    }

    public function confirmUpdate(Request $request ,$id, CashierService $service){
        $order = Order::findOrFail($id);
        if(\Carbon\Carbon::parse($order->created_at)->format('y-m-d') != \Carbon\Carbon::parse($request->created_at)->format('y-m-d')){
            $serial = $order->id."-".\Carbon\Carbon::parse($order->created_at)->format('ymd').'-'.sprintf('%03d', \App\Models\Order::whereDate('created_at', $order->created_at)->count());
            $order->update(['serial' => $serial, 'created_at' => $request->created_at]);
        }
        $service->log($order->id,'Updated Invoice');
        return  redirect()->route('cashier-show',$order->id)->with('success','Order Created Successfully');
    }
}
