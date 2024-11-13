<?php

namespace App\Http\Resources\Data\Invoices;

use App\Http\Resources\Admin\Orders\Cashier\OrderDetailResource;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInvoiceResource extends JsonResource
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
            "total" => $this->orders->sum('total')
        ];
    }
}
