<?php

namespace App\Http\Resources\Data\Checkout;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "state" => $this->state,
            "post_code" => $this->post_code,
            "city" => $this->city,
            "details" => $this->address,
           // "user" => $this->when($this->user_id !=null,$this->user->name),
           //"customer" => $this->when($this->customer_id !=null,$this->customer->name),

        ];
    }
}
