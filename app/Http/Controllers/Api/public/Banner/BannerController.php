<?php

namespace App\Http\Controllers\Api\public\Banner;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Admin\Banner\BannerResource;
use App\Http\Resources\Admin\Products\ProductResource;
use App\Http\Resources\Data\Meta\MetaResource;
use App\Http\Resources\Data\Products\CategoryWithProductsResource;
use App\Models\Banner;
use App\Models\Category;
use App\Models\MetaSeo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $banners = Banner::get();
         $offers = Product::whereHas('prices', function ($query) {
                             $query->where('discount', '>', 0.01);
                        })->with(['prices' => function ($query) {
                             $query->where('discount', '>', 0.01);
                        }])->latest('id')->get();
        $categoriesProducts = Category::with(['products' => function ($query) {
            $query->with('prices')->latest('id');
        }])->get();
        $meta = MetaSeo::wherePageId(1)->first();
        return ResponseHelper::sendResponseSuccess([
            'meta' => new MetaResource($meta),
            'banners' => BannerResource::collection($banners),
            'offers' => ProductResource::collection($offers),
            'categoriesProducts' => CategoryWithProductsResource::collection($categoriesProducts)
        ]);
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
