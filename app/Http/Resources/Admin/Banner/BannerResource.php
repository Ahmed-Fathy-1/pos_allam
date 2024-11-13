<?php

namespace App\Http\Resources\Admin\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "status" => $this->status,
            "category_id" => $this->category_id,
            "text_color" => $this->text_color,
            "image" => asset('storage/banners/'.$this->image),
        ];
    }
}
