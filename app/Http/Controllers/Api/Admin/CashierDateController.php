<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Product;
use App\Models\productPrice;
use App\Models\User;
use Illuminate\Http\Request;

class CashierDateController extends Controller
{
    public function address($mobile){
        $customer = Customer::whereMobile($mobile)->first();
        $user = User::whereMobile($mobile)->first();
        if (isset($customer,$user)){
            $onlineAddress = Address::whereUserId($user->id)->select('*');
            $cahierAddress = Address::whereCustomerId($customer->id)->select('*');
            $addresses = $onlineAddress->union($cahierAddress)->get();
        }elseif (isset($user)){
            $addresses = Address::whereUserId($user->id)->get();
        }else {
            $addresses = Address::whereCustomerId($customer->id)->get();
        }

        return $addresses;
    }

    public function unit($id){
        $unitid = \App\Models\productPrice::whereProductId($id)->pluck('unit_id');
        return $units = \App\Models\Unit::whereIn('id',$unitid)->get();
    }
}
