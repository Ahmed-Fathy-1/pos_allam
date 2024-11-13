<?php

namespace App\Http\Controllers\Api\public\Data;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Admin\Category\Categoryresource;
use App\Http\Resources\Admin\Products\ProductResource;
use App\Http\Resources\Data\Footer\FooterREsource;
use App\Http\Resources\Data\Meta\MetaResource;
use App\Http\Resources\Data\Products\ProductDetails;
use App\Http\Resources\Data\Unit\UnitResource;
use App\Models\Category;
use App\Models\MetaSeo;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublicDataController extends Controller
{
    public function category(){
        try {
            $category  = Category::whereHas('meta')->with('meta')->get();
            return ResponseHelper::sendResponseSuccess( Categoryresource::collection($category));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function categoryShow($id){
        try {
           $category = Category::whereSlugUrl($id)->orWhere('new_redirection',$id)->firstOrFail();
            if(!$category){
                return  ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,'This Category Not Exists');
            }
            $meta = MetaSeo::whereCategoryId($category->id)->first();
            $products = Product::whereCategoryId($category->id)->whereStatus(true)->with('prices')->get();
            return ResponseHelper::sendResponseSuccess([
                'meta' => new MetaResource($meta),
                'category' => new  Categoryresource($category),
                "products" => ProductResource::collection($products)
            ]);
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function showProduct($id){
        try {
            $product = Product::whereSlugUrl($id)->orWhere('new_redirection',$id)->with('prices')->find($id);
            $meta = MetaSeo::whereProductId($product->id)->firstOrFail();
            if(!$product){
                return  ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,'This Product Not exists');
            }
            $relatedProduct = Product::where('id','!=',$id)->whereCategoryId($product->category_id)->take(15)->get();

            return ResponseHelper::sendResponseSuccess([
                'meta' => new MetaResource($meta),
                'product' => new ProductResource($product),
                'simmilerProducts' => ProductResource::collection($relatedProduct)
            ]);
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function units(){
        $units = Unit::get();
        return ResponseHelper::sendResponseSuccess(UnitResource::collection($units));
    }

    public function search(Request $request){
        $search = $request->product_name;
        $products = Product::where('name','LIKE','%'.$search.'%')->get();
        return ResponseHelper::sendResponseSuccess(ProductResource::collection($products));
     }

     public function footer(){
          $settings = Setting::get();
         return ResponseHelper::sendResponseSuccess(FooterREsource::collection($settings));
     }
     public function sitemapXml(){
         $file = asset('storage/sitemap/sitemap.xml');
         return \Illuminate\Support\Facades\Response::make(file_get_contents($file), 200, [
             'Content-Type' => 'application/xml',
         ]);
     }
}
