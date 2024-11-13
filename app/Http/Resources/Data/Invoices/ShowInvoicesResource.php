<?php

namespace App\Http\Resources\Data\Invoices;

use App\Http\Resources\Admin\Orders\Cashier\OrderDetailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowInvoicesResource extends JsonResource
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
            "name" => $this->name,
            'email' => $this->email,
            "mobile" => $this->mobile,
            "order_count" => $this->orders->count(),
            "order_details" => $this->whenLoaded('orders',OrderDetailResource::collection($this->orders->flatMap->orderDetails)),
            "total" => $this->orders->sum('total')
        ];
    }
}
