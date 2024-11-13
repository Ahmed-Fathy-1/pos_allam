<?php

namespace App\Http\Resources\Admin\Orders\Cashier;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $details = OrderDetail::whereOrderId($this->id)->get();
        return [
            "id" => $this->id,
            "client" => $this->user_name,
            "address" => $this->address,
            "delivery_status" => $this->delivery_status,
            "payment_method" => $this->payment_method,
            "order_details" => OrderDetailResource::collection($details),
            "cashier" => $this->cashier,
            "sub_total" => $this->sub_total,
            "total_discount" => $this->total_discount,
            "total" => $this->total,

        ];
    }
}
