<?php

namespace App\services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AUSPOSTService
{
    // خدمات البريد المحليه
    public function getListAvailableDomesticPostageServices($data): bool|Collection
    {
        $response = Http::withHeaders([
            'AUTH-KEY' => config('shipping.shipping_methods.australia_post.api_key')
        ])->get('https://digitalapi.auspost.com.au/postage/parcel/domestic/service.json',[
            'from_postcode' => \App\Models\Setting::where('key', 'post_code')->value('value'),

            'to_postcode'   => Arr::get($data, 'to_postcode'),
////                        'length'        => Arr::get($data, 'total_length'),
//            'length'        => 50,
////                        'width'         => Arr::get($data, 'total_width'),
//            'width'         => 50,
////                        'height'        => Arr::get($data, 'total_height'),
//            'height'        => 50,
////                        'weight'        => Arr::get($data, 'total_weight'),
            'weight'        => 2,
        ]);

        if($response->successful())
            return $response->collect();

        return false;
    }

    public function calculateTotalDeliveryPrice($data): bool|Collection
    {

        $response = Http::withHeaders([
            'AUTH-KEY' => config('shipping.shipping_methods.australia_post.api_key')
        ])->get('https://digitalapi.auspost.com.au/postage/parcel/domestic/calculate.json', [
            'from_postcode' => \App\Models\Setting::where('key', 'post_code')->value('value'),

            'to_postcode'   => Arr::get($data, 'to_postcode'),
//                        'length'        => Arr::get($data, 'total_length'),
//            'length'        => 50,
////                        'width'         => Arr::get($data, 'total_width'),
//            'width'         => 50,
////                        'height'        => Arr::get($data, 'total_height'),
//            'height'        => 50,
////                        'weight'        => Arr::get($data, 'total_weight'),
//            'weight'        => 2,
            'service_code'  => Arr::get($data, 'service_code')
        ]);

        if($response->successful())
            return $response->collect();
        return false;
    }
}
