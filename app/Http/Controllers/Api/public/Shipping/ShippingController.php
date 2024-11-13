<?php

namespace App\Http\Controllers\Api\public\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Checkout\DeliveryServicesResource;
use App\services\ShippingMethods;
use App\Services\ShippingMethods\DeliveryPostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function delivery()
    {


            $availableDomesticPostageServices = (new ShippingMethods())->listOfAvailableServices();
            if(!$availableDomesticPostageServices){
                return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,'Sorry! No Available Domestic Postage Service');
            }

             return  $availableDomesticPostageServices;

            // notes handel response as resource
            return ResponseHelper::sendResponseSuccess(DeliveryServicesResource::collection($availableDomesticPostageServices['services']['service']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
