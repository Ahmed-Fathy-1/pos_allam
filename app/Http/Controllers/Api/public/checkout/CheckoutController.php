<?php

namespace App\Http\Controllers\Api\public\checkout;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Api\checkout\CouponRequest;
use App\Http\Requests\Api\checkout\OrderRequest;
use App\Http\Resources\Data\Cart\CartResource;
use App\Http\Resources\Data\Checkout\UserOrderResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponLogs;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\User;
use App\services\Order\OrderServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CheckoutController extends Controller
{
    public function index(){

        $orders = Order::whereMobile(auth('api')->user()->mobile)->latest('id')->get();
        return ResponseHelper::sendResponseSuccess( UserOrderResource::collection($orders));
    }

    public function coupon(CouponRequest $request){
        try {
            $code = $request->coupon;
            $coupon  = Coupon::where(function ($q) use ($code){
                $q->whereCode($code)->whereColumn('limit', '>=', 'n_usage')->where('end_at', '>=', Carbon::now());
            })->first();
            if(!$coupon){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'This coupon is Not Exists Or Expired');
            }
            $logs = CouponLogs::where('coupon_id',$coupon->id)->whereUserId(auth('api')->user()->id)->first();
            if($logs){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'You Are Using This Coupon before');
            }
            $cart = Cart::whereUserId(auth('api')->user()->id)->with('cartDetails')->first();
            if($cart->coupon_id !=null){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'You Are Using Coupon before');
            }
            $discount = (($cart->total * $coupon->discount) / 100);
            $total = $cart->total - $discount;
            $coupon->update([
                'n_usage' => $coupon->n_usage + 1
            ]);
            CouponLogs::create([
                "coupon_id" => $coupon->id,
                "user_id" => auth('api')->user()->id,
                "logs" => "Active"
            ]);
            $cart->update(['coupon_id' => $coupon->id,'total' => $total]);
            return ResponseHelper::sendResponseSuccess([new CartResource($cart)]);
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function order(OrderRequest $request,OrderServices $services){
        try{
            $cart = Cart::where('user_id', auth('api')->id())->with('cartDetails')->first();
           $shippingValue = Setting::where('key', 'shipping')->first();
            if($shippingValue->value !=null){
              $delivery =  $shippingValue->value;
            }else{
                $delivery = 0;
            }
            $user = User::whereId($cart->user_id)->first();
            $name = $user->name ; $mobile = $user->mobile;
            $address = Address::find($cart->address_id);
            $recipentAddress = $address->address .", ". $address->city .", ". $address->state .", ". $address->post_code;
            $order = Order::create([
                'mobile' =>$mobile,
                "address_id" => $cart->address_id,
                "coupon_id" => $cart->coupon_id ?? null,
                "payment_method" =>$request->payment_method,
                "total_gst" => $cart->CartDetails()->sum('gst'),
                "sub_total" => $cart->CartDetails()->sum('sub_total'),
                "total_discount" => $cart->CartDetails()->sum('total_discount'),
                "total" => $cart->total + $delivery,
                'shipping' => $delivery
            ]);
            $services->orderDetails($order->id);
            $client = new Party([
                'name'          => "Butcher" . " (" .Setting::where('key','mobile')->value('value') ." )",
                'phone'         => Setting::where('key','abn')->value('value'),
                'address'       =>  Setting::where('key','address')->value('value')
            ]);
            $customer = new Party([
                'name'          => $name . " (" .$mobile . " )" ,
                'address'       => $recipentAddress ,
                'phone'         => "personal",
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
            return ResponseHelper::sendResponseSuccess(new UserOrderResource($order));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    // strip payment
    public function createStripePaymentIntern($id){
        DB::beginTransaction();
        try {
            $order = Order::where('id',$id)->whereMobile(auth('api')->user()->mobile)->firstOrFail();
            $amount = $order->total * 100;
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $paymentIntent=  $stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => 'aud',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
           // dd($paymentIntent);
            $payment = new Payment();
            $payment->forceFill([
                "order_id" =>$id,
                "amount" =>$paymentIntent->amount,
                "currency" =>$paymentIntent->currency,
                "methods" => "Stripe",
                "status" => "pending",
                "transaction_id" => $paymentIntent->id,
                "transaction_data" => json_encode($paymentIntent),
            ])->save();
            DB::commit();
            return ResponseHelper::sendResponseSuccess([
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent' => $paymentIntent->id,
            ]);
        }catch (\Exception $ex){
            DB::rollBack();
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function summery(Request $request,$id)
    {
        try {
            $order = Order::where('id',$id)->whereMobile(auth('api')->user()->mobile)
                        ->with('orderDetails')->firstOrFail();
            // delete cart if completed success order
            $cart = Cart::where('user_id',auth('api')->id())->with('cartDetails')->first();
            if($order->payment_method == \App\Enums\paymentMethodEnum::Online->value ){
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $paymentIntent =   $stripe->paymentIntents->retrieve(
                    $request->query('payment_intent'),
                         []
                );
                if($paymentIntent->status == 'succeeded'){
                    // save payment process
                    $payment = Payment::whereOrderId($order->id)->firstOrFail();
                    $payment->forceFill([
                        "status" => "completed",
                        "transaction_data" => json_encode($paymentIntent),
                    ])->save();
                    $cart->cartDetails()->delete();
                    $cart->delete();
                    return ResponseHelper::sendResponseSuccess(new UserOrderResource($order));
                }else{
                    return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$paymentIntent->status);
                }
            }elseif ($order->payment_method ==  \App\Enums\PaymentMethodEnum::Cash->value){
                $cart->cartDetails()->delete();
                $cart->delete();
                return ResponseHelper::sendResponseSuccess(new UserOrderResource($order));
            }
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

}
