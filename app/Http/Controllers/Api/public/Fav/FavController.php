<?php

namespace App\Http\Controllers\Api\public\Fav;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Data\Fav\FaveResource;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FavController extends Controller
{
    public function index(){
        try {
            $favs = Favourite::whereUserId(auth('api')->user()->id)->get();
            if(count($favs) < 0){
                return  ResponseHelper::sendResponseSuccess('fav is Empty');
            }
            return  ResponseHelper::sendResponseSuccess([FaveResource::collection($favs)]);
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function store($id){
        try {

            $product = Product::findOrFail($id);
            $user = auth('api')->user()->id;
            $fav =   Favourite::firstOrCreate(
                        [
                            'user_id'       => $user,
                            'product_id'    => $id
                        ],
                        [
                            'user_id'       => $user,
                            'product_id'    => $id
                        ]
                 );
            $countClientFavourites = Favourite::where('user_id', $user)->count();
            return ResponseHelper::sendResponseSuccess(new FaveResource($fav));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }
    public function destroy($id){
        try {
            $fav =  Favourite::whereProductId($id)->whereUserId(auth('api')->user()->id)->first();
            if(!$fav){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'This product not Fav for user');
            }
            $fav->delete();
            return ResponseHelper::sendResponseSuccess('Product Delete From Fav Successfully');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }
}
