<?php

namespace App\services\cashier;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\productPrice;

class cartServices
{
    public function addCart($data){
        $product = Product::findOrFail($data['product_id']);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $price = $data['price'];
        $product_details = productPrice::whereUnitId($data['unit_id'])->whereProductId($data['product_id'])->first();
        // $shippingValue = Setting::where('key', 'shipping')->value('value');
        $priceAfterDiscount = ($price + $product_details->gst )  -  $product_details->discount;
        $subTotal = $priceAfterDiscount *  $data['quantity'];

        $cartDetails =  $cart->cartDetails()->updateOrCreate(
            [
                'cart_id' => $cart->id,
                "product_id" => $data['product_id'],
                "unit_id" => $data['unit_id'],
            ],
            [
                "quantity" => $data['quantity'],
                'price' =>$price,
                "gst" => $product_details->gst * $data['quantity'],
                "price_after_discount" => $priceAfterDiscount,
                "total_discount" =>   $product_details->discount * $data['quantity'],
                "sub_total" => $subTotal,
            ]);
        $cartDetails->refresh();
        $cart->update(['total' => $cart->cartDetails()->sum('sub_total')]);
        $cart->refresh();
        return $cart;
    }

    public function updateorder($data){
       $order = Order::findOrFail($data['id']);
        $price = $data['price'];
        $product_details = productPrice::whereUnitId($data['unit_id'])->whereProductId($data['product_id'])->first();
        $priceAfterDiscount = ($price + $product_details->gst )  -  $product_details->discount;
        $subTotal = $priceAfterDiscount *  $data['quantity'];

        $orderDetails =  $order->orderDetails()->updateOrCreate(
            [
                'order_id' => $order->id,
                "product_id" => $data['product_id'],
                "unit_id" => $data['unit_id'],
            ],
            [
                "quantity" => $data['quantity'],
                'price' =>$price,
                "gst" => $product_details->gst * $data['quantity'],
                "discount" =>   $product_details->discount * $data['quantity'],
                "sub_total" => $subTotal,
            ]);
        $orderDetails->refresh();
        $order->update([
            "total_discount" => $order->orderDetails()->sum('discount'),
            "total_gst" => $order->orderDetails()->sum('gst'),
            'total' => $order->orderDetails()->sum('sub_total'),
            ]);
        $order->refresh();
        return $order;
    }




}
