<?php

namespace App\Http\Controllers\Api\public\checkout;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Api\checkout\StoreAddress;
use App\Http\Resources\Data\Cart\CartResource;
use App\Http\Resources\Data\Checkout\AddressResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customer = Customer::whereMobile(auth('api')->user()->mobile)->first();
            if($customer){
                $onlineAddress = Address::whereUserId(auth('api')->user()->id)->select('*');
                $cahierAddress = Address::whereCustomerId($customer->id)->select('*');
                $addresses = $onlineAddress->union($cahierAddress)->get();
            }else{
                $addresses = Address::whereUserId(auth('api')->user()->id)->get();
            }

            return ResponseHelper::sendResponseSuccess(AddressResource::collection($addresses));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddress $request)
    {
        try {
            $address = Address::create($request->validated()+['user_id' => auth('api')->user()->id]);
            $cart = Cart::where('user_id', auth('api')->id())->first();
            $cart->update(['address_id' => $address->id]);
            return ResponseHelper::sendResponseSuccess( ['address' => new AddressResource($address),'cart' => new CartResource($cart)]);
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function select(string $id)
    {
        try {
            $cart = Cart::where('user_id', auth('api')->id())->first();
            $cart->update(['address_id' => $id]);
            return ResponseHelper::sendResponseSuccess(new CartResource($cart));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
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
        try {
            $address = Address::findOrFail($id);
            $address->delete();
            return ResponseHelper::sendResponseSuccess('Address Deleted Successfully');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());

        }
    }
}
