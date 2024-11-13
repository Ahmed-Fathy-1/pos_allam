<?php

namespace App\services;

use App\Models\Cart;
use ReflectionException;

class ShippingMethods
{
    /**
     * @throws ReflectionException
     */
    public function listOfAvailableServices()
    {
        $cart = Cart::where('user_id', auth('api')->id())->first();

        $serviceClassOfShippingMethod = '\\App\\services\\AUSPOSTService';

        $dataOfTotals = ['to_postcode' => $cart->address->post_code];

        return (new $serviceClassOfShippingMethod())->getListAvailableDomesticPostageServices($dataOfTotals);
    }
}
