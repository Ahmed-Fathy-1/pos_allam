<?php

namespace App\services\cashier;

use App\Enums\PaymentStatusEnum;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Log;
use App\Models\OrderDetail;
use App\Models\PaymentTransfer;
use App\Models\priceLogs;
use App\Models\Product;
use App\Models\productPrice;
use App\Models\Setting;
use App\Models\User;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use Illuminate\Support\Facades\DB;

class CashierService
{

    public function allCustomers(){
        $customers = Customer::whereHas('addresses')->get();
        return $customers;
    }

//     address customer
    public function address($id){
        $customer = Customer::findOrFail($id);
            $addresses = Address::whereCustomerId($customer->id)->get();
        return $addresses;
    }

    public function userDelivery(){
        $delivery = User::whereRoleName('delivery')->get();
        return $delivery;
    }

    //users or customers get data json
    public function customer($id){
        $data = Customer::findOrFail($id);
        return $data;
    }

    // recommendations
    public function recommendation($id){
        $products = Product::whereHas('specialPrices', function ($q) use ($id) {
                             $q->where('customer_id', $id);
                            })->with(['specialPrices' => function ($q) use ($id) {
                                $q->where('customer_id', $id);
                            }])->get();

        return $products;
    }

    // orderDetails
    public function orderDetails($id,$order_details){
        foreach ($order_details as $details){
            $product = productPrice::whereUnitId($details['unit'])->whereProductId($details['product_id'])->first();
            $stock = $product->stock - $details['quantity'];
            if (isset($details['new_price'])) {
                $price = $details['new_price'];
                $discount = 0;
                $this->updatePrice($details['product_id'],$details['unit'],$stock,$price);
            }else{
                $price = $product->price;
                $discount = $product->discount;
                $product->update(['stock' => $stock]);
            }
            OrderDetail::create([
                "order_id" => $id,
                "product_id" => $details['product_id'],
                'quantity' => $details['quantity'],
                "price" => $price,
                'unit_id' => $details['unit'],
                "discount" => $discount * $details['quantity'],
                'gst' => $product->gst * $details['quantity'],
                "sub_total" => (($price * $details['quantity']) + ($product->gst * $details['quantity'])) - ($discount * $details['quantity'])
            ]);
        }
    }

    //update orders cashier
    public function updateOrder($order){
        $sub_total = $order->orderDetails->sum('sub_total');
        $all_discount = $order->orderDetails()->sum('discount');
        $total_gst = $order->orderDetails()->sum('gst');
        $shippingValue = Setting::where('key', 'shipping')->first();
        if($shippingValue->value !=null){
            $delivery =  $shippingValue->value;
        }else{
            $delivery = 0;
        }
        $order->update([
            "total_discount" =>$all_discount,
            'total_gst' => $total_gst,
            "total" => $sub_total + $delivery,
        ]);
    }

    // invoice create
    public function invoice($id,$order,$address){
        $recipient = Customer::find($id);
        ############# invoice ################3
        // seller
        $client = new Party([
            'name'          => auth()->user()->name,
            'phone'         => auth()->user()->mobile,
        ]);
        $customer = new Party([
            'name'          => $recipient->name,
            'address'       => $address,
            'custom_fields' => [
                'order number' => $order->id,
            ],
        ]);
        $items = [];
        foreach ( $order->orderDetails as $orderInvoce ){
            $items [] =
                InvoiceItem::make($orderInvoce->product->name)
                    //->description('Your product or service description')
                    ->pricePerUnit($orderInvoce->price)
                    ->quantity($orderInvoce->quantity)
                    ->discount($orderInvoce->discount)
                    ->tax($orderInvoce->gst);
        }
        $notes = [
//            'we added ' . $tax . ' % tax on orders Total'  ,
        ];
        $notes = implode("<br>", $notes);
        $invoice = Invoice::make('Butcher')
            // ->sequence($order->total)
            ->seller($client)
            ->buyer($customer)
            ->date(now())
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
    }



    // update new price of product
   private function updatePrice ($id,$unitId,$stock,$price){
        $product = productPrice::whereUnitId($unitId)->whereProductId($id)->first();
           priceLogs::create([
               "product_id" => $id,
               "unit_id" => $unitId,
               "old_price" => $product->price,
               "new_price" => $price,
               "user_id" => auth()->user()->id
           ]);
        $product->update(['price' => $price,'discount' => 0,"stock" => $stock,]);
   }

    public function orderDetailsCart($id){
        $cart = Cart::where('user_id', auth()->id())->with('cartDetails')->first();
        if($cart){
            foreach($cart->cartDetails as $cartDetail) {
                $this->updateStock($cartDetail->product_id,$cartDetail->unit_id,$cartDetail->quantity);
                OrderDetail::create([
                    'product_id' => $cartDetail->product_id,
                    "order_id" =>$id,
                    "unit_id" => $cartDetail->unit_id,
                    "quantity" => $cartDetail->quantity,
                    "price" => $cartDetail->price,
                    "discount" => $cartDetail->total_discount,
                    'gst' => $cartDetail->gst,
                    "sub_total" => $cartDetail->sub_total
                ]);
            }
            $cart->cartDetails()->delete();
            $cart->delete();
        }
    }

    public function balance($balance,$total){
        if($balance >= $total ){
            $data = [
                'order' => [
                    'status' => 1,
                    'payment_type' =>3,
                    'paid_at' => $serveBalance['paid_at']??null,
                    'amount_paid' =>$total,
                    'remaining_amount' => 0,
                ],
                'pay' => [
                    'amount_paid' =>$balance,
                    'total_due' => $total,
                    "remaining" => 0,
                    'over_payment' => $balance - $total,
                    'payment_type' => 3,
                ]
            ];
        }else{
            $data=[
                'order' => [
                    'status' => 2,
                    'payment_type' => 3,
                    'paid_at' => $serveBalance['paid_at']??null,
                    'amount_paid' =>$balance,
                    'remaining_amount' => $total-$balance,
                ],
                'pay' => [
                    'amount_paid' =>$balance,
                    'total_due' => $total,
                    "remaining" =>  $total - $balance,
                    'over_payment' => 0,
                    'payment_type' => 3,
                ]
            ];
        }
        return $data;
    }

    public  function log($id,$action){
        Log::create(['action' => $action,'order_id' => $id,'user_id' => auth()->user()->id]);
    }

    public function logPayment($data){
        $generalPayment = PaymentTransfer::create($data['pay']);
        $generalPayment->ordersTansfer()->attach($data['pay']['order_id'],['deserved_amount' => $data['pay']['total_due'],'amount_paid' => $data['order']['amount_paid']]);
    }

    private function updateStock($pId,$uId,$quantity){
        $productStock = productPrice::where(function ($q) use ($pId,$uId,$quantity){
            $q->whereProductId($pId)->whereUnitId($uId);
        })->firstOrfail();
        $stock = $productStock->stock - $quantity;
        $productStock->update(['stock' => $stock]);
    }






}
