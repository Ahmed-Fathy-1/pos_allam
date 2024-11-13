<?php

namespace App\Http\Resources\Admin\Products;

use App\Http\Resources\Admin\Category\Categoryresource;
use App\Http\Resources\Data\Products\PriceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = [];
        if($this->images > 0){
            foreach ($this->images as $image){
                $images [] = asset('storage/'.$image);
            }
        }
        $alts = [];
        if ($this->alts > 0){
            foreach ($this->alts as $alt){
                $alts [] = $alt;
            }
        }
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug_url" =>$this->slug_url,
            "new_redirection" =>$this->new_redirection,
            "description" => $this->description,
            "category_id" => new Categoryresource($this->category),
            "images" => $images,
            "alts" => $alts,
            "prices" => PriceResource::collection($this->prices)
        ];
    }
}
