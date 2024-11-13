<?php

namespace App\services\Order;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\productPrice;

class OrderServices
{
    public function orderDetails($id){
        $cart = Cart::where('user_id', auth('api')->id())->with('cartDetails')->first();
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

        }
    }

    private function updateStock($pId,$uId,$quantity){
        $productStock = productPrice::where(function ($q) use ($pId,$uId,$quantity){
            $q->whereProductId($pId)->whereUnitId($uId);
        })->firstOrfail();
        $stock = $productStock->stock - $quantity;
        $productStock->update(['stock' => $stock]);
    }
}
