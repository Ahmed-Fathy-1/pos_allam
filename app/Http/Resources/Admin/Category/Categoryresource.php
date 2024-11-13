<?php

namespace App\Http\Resources\Admin\Category;

use App\Http\Resources\Data\Meta\MetaResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Categoryresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = [];
        if(count($this->images) > 0){
            foreach ($this->images as $image){
                $image = asset('storage/'.$image);
                $images [] =$image;
            }
        }
        return [
            'id' => $this->id,
            "name" => $this->name,
            "slug_url" =>$this->slug_url,
            "new_redirection" =>$this->new_redirection,
            "description" => $this->description,
            'images' => $images,
            'alts' => $this->alts,
            "meta" => new  MetaResource($this->meta)
        ];
    }
}
