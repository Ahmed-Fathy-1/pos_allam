<?php

namespace App\services\product;

use App\Models\CustomerPrice;
use App\Models\MetaSeo;
use App\Models\priceLogs;
use App\Models\Product;
use App\Models\productPrice;
use App\Models\StockLog;
use Illuminate\Support\Str;

class productPriceService
{
    public function productPrice($productId,$datas){
        foreach ($datas as $data){
            productPrice::create([
                "product_id" => $productId,
                "stock" => $data['stock'],
                "user_id" => auth()->user()->id,
                "unit_id" => $data['unit_id'],
                "price" => $data['price']??0,
                "discount" => $data['discount']??0,
                'gst' => $data['gst']??0,
            ]);
        }
    }

    public function specialPrice($id,$datas)
    {
        foreach ($datas as $data){
            if($data['customer_id'] != null){
                CustomerPrice::updateOrCreate(
                    [
                        "product_id" => $id,
                        "unit_id" => $data['unit_id'],
                        "customer_id" => $data['customer_id']
                    ],
                    [
                        "user_id" => auth()->user()->id,
                        "price" => $data['price'],
                    ]
                );
            }

        }
    }

    public function format($alt){
        $alts = explode(',', $alt);
        $formattedAlts = array_map(function($alt) {
            return Str::of(trim($alt))->trim('"')->__toString();
        }, $alts);
        return $formattedAlts;
    }

    public function priceUpdate($productId,$datas){
        $product = Product::findOrfail($productId);
        foreach ($datas as $data){
            $oldPrice = productPrice::whereProductId($productId)->whereUnitId($data['unit_id'])->first();
            $product->prices()->updateOrCreate(
                [
                    "product_id" => $productId,
                    "unit_id" => $data['unit_id']
                ],
                [
                    "user_id" => auth()->user()->id,
                    "stock" => $data['stock'],
                    "price" => $data['price'],
                    "discount" => $data['discount']??0,
                    'gst' => $data['gst']??0,
                ]
            );
            if($oldPrice){
                if ($oldPrice->price != $data['price']){
                    priceLogs::create([
                        "product_id" => $productId,
                        "unit_id" => $data['unit_id'],
                        "old_price" => $oldPrice->price,
                        "new_price" => $data['price'],
                        "user_id" => auth()->user()->id
                    ]);
                }

                if ($oldPrice->stock != $data['stock']){
                    StockLog::create([
                        "product_id" => $productId,
                        "unit_id" => $data['unit_id'],
                        "old_stock" => $oldPrice->stock,
                        "new_stock" =>  $data['stock'],
                        "user_id" => auth()->user()->id
                    ]);
                }

            }


        }
    }

    public function meta($productId,$title,$canonical,$keyword,$description,$schema_markup){

        MetaSeo::create([
            "title" => $title,
            "canonical_url" => $canonical,
            "keyword" => $keyword,
            "description" => $description,
            "schema_markup" => $schema_markup,
            "product_id" => $productId
        ]);
    }

    public function metaUpdate($productId,$title,$canonical,$keyword,$description,$schema_markup){
        $meta = MetaSeo::whereProductId($productId)->firstOrFail();
        $meta->update([
            "title" => $title,
            "canonical_url" => $canonical,
            "keyword" => $keyword,
            "description" => $description,
            "schema_markup" => $schema_markup,
        ]);
    }


}
