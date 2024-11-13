<?php

namespace App\services\cashier;

use App\Models\Address;

class addressService
{
    public function address($id,$state,$city,$post_code,$address){
        Address::create([
           'state' => $state,
           "city" => $city,
           "post_code" => $post_code,
           "address" => $address,
           "customer_id" => $id
        ]);
    }

}
