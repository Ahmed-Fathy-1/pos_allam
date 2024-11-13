<?php

namespace App\Http\Controllers\Api\public\Cart;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Api\cart\AddCartRequest;
use App\Http\Requests\Api\cart\CartDeleteRequest;
use App\Http\Requests\Api\cart\increaseDecreseRequest;
use App\Http\Resources\Data\Cart\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\productPrice;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cart = Cart::where('user_id',auth('api')->id())->with('cartDetails')->first();
            if(!$cart){
                return  ResponseHelper::sendResponseSuccess(['cart_details' => []]);
            }
            return ResponseHelper::sendResponseSuccess(new CartResource($cart));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * Store product first Time To Carts.
     */

    public function store(AddCartRequest $request,$id)
    {
        try {
            $product = Product::whereId($id)->firstOrFail();
            $cart = Cart::firstOrCreate(['user_id' => auth('api')->id()]);
            $price = productPrice::whereUnitId($request->unit_id)->whereProductId($product->id)->first();
         //  $shippingValue = Setting::where('key', 'shipping')->value('value');
            $priceAfterDiscount = ($price->price + $price->gst )  -  $price->discount;
            $subTotal = $priceAfterDiscount *  ($request->quantity);
            $cartDetails =  $cart->cartDetails()->updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    "product_id" => $id,
                    "unit_id" => $request->unit_id
                ],
                [
                "quantity" => $request->quantity,
                'price' =>$price->price,
                "gst" => $price->gst * $request->quantity,
                "price_after_discount" => $priceAfterDiscount,
                "total_discount" =>   $price->discount * $request->quantity,
                "sub_total" => $subTotal,
            ]);
            $cartDetails->refresh();
            $cart->update(['total' => $cartDetails->sum('sub_total')]);
            $cart->refresh();
            return ResponseHelper::sendResponseSuccess(['cart'=> new CartResource($cart)]);
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * Update cart Details increase or Decrease product on cart.
     */
//    public function update(increaseDecreseRequest $request, string $id)
//    {
//        try {
//            $cart = Cart::where('user_id',auth('api')->id())->with('cartDetails')->first();
//            if(!$cart){
//                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'Not added products to cart before ');
//            }
//            $cartDetail = $cart->cartDetails->where('product_id', $id)->first();
//            if(!$cartDetail){
//                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'Add Product To Cart , Then Increase Or decrease it');
//            }
//            if($request->quantity == 0){
//                $cartDetail->delete();
//                $count = $cartDetail->count();
//                if($count == 0){
//                    $cart->delete();
//                }
//                return ResponseHelper::sendResponseSuccess('product deleted From Cart');
//            }
//            $cartDetail->update([
//                'quantity' => $request->quantity,
//                "total_discount" =>$cartDetail->total_discount * $request->quantity,
//                "sub_total" => $cartDetail->sub_total * $request->quantity ,
//                'total' =>$cartDetail->price_after_discount * $request->quantity,
//            ]);
//            $cartDetail->refresh();
//            $cart->refresh();
//            return ResponseHelper::sendResponseSuccess(new CartResource($cart));
//        }catch (\Exception $ex){
//            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
//        }
//    }

    public function cartStorage(Request $request){
        try {
            $cart = Cart::firstOrCreate(['user_id' => auth('api')->user()->id]);
            foreach ($request->cart_details as $detail){
                $product = Product::whereId($detail['product_id'])->firstOrFail();
                $price = productPrice::whereUnitId($detail['unit_id'])->whereProductId($detail['product_id'])->first();
                $priceAfterDiscount = ($price->price + $price->gst )  -  $price->discount;
                $subTotal = $priceAfterDiscount *  ($detail['quantity']);
                $cartDetails =  $cart->cartDetails()->updateOrCreate(
                    [   'cart_id' => $cart->id,
                        "product_id" => $detail['product_id'],
                        "unit_id" => $detail['unit_id']
                    ],
                    [
                        "quantity" => $detail['quantity'],
                        'price' =>$price->price,
                        "gst" => $price->gst * $detail['quantity'],
                        "price_after_discount" => $priceAfterDiscount,
                        "total_discount" =>   $price->discount *  $detail['quantity'],
                        "sub_total" => $subTotal,
                   ]
                );
            }
            $cart->update(['total' => $cart->cartDetails()->sum('sub_total')]);
            return ResponseHelper::sendResponseSuccess(new CartResource($cart));

        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartDeleteRequest $request){
        try {
            $cart = Cart::where('user_id', auth('api')->id())->with('cartDetails')->first();
            if(!$cart){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'No Products yet on cart');
            }
            $product = $cart->cartDetails()->where('product_id',$request->product_id)->where('unit_id',$request->unit_id)->first();
            if(!$product){
                return  ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'This product or Unit not exists');
            }
            $product->delete();
            $count = $cart->cartDetails()->count();
            if($count == 0){
                $cart->delete();
            }
            return ResponseHelper::sendResponseSuccess('product deleted successfully from cart');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function destroyAll(){
        try {
            $cart = Cart::where('user_id', auth('api')->id())->with('cartDetails')->first();
            if(!$cart){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'No Products yet on cart');
            }
            $cart->cartDetails()->delete();
            $cart->delete();
            return ResponseHelper::sendResponseSuccess([], ResponseAlias::HTTP_OK,'Cart Is Empty');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }
}
