<?php

namespace App\Http\Resources\Admin\Report;

use App\Enums\deliveryStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderReportResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->cashier_id != null)
            $status = "OnCashier";
        else
            $status = "OnlinePayment";
        return [
            'id' => $this->id,
            "date" => $this->created_at,
            "status" => $status,
            'delivery_status' => deliveryStatusEnum::from($this->delivery_status)->name,
            'order_details' => $this->orderDetails,
            'quantity' => $this->orderDetails->count(),
            "total" => $this->total,

        ];
    }
}
