<?php

namespace App\services\Order;

use App\Models\OrderDetail;
use App\Models\priceLogs;
use App\Models\productPrice;
use App\Models\Setting;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class OrderSeeder
{
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

    private function updatePrice ($id,$unitId,$stock,$price){
        $product = productPrice::whereUnitId($unitId)->whereProductId($id)->first();
        priceLogs::create([
            "product_id" => $id,
            "unit_id" => $unitId,
            "old_price" => $product->price,
            "new_price" => $price,
            "user_id" =>1
        ]);
        $product->update(['price' => $price,'discount' => 0,"stock" => $stock,]);
    }
}
