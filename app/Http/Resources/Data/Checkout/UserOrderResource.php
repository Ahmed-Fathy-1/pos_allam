<?php

namespace App\Http\Resources\Data\Checkout;

use App\Http\Resources\Admin\Orders\Cashier\OrderDetailResource;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends JsonResource
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
            "user" => $this->when($this->user_id != null,$this->user->name),
            "customer" => $this->when($this->customer_id != null,$this->customer->name),
            "address" => new AddressResource(Address::find($this->address_id)),
            "coupon" => $this->when($this->coupon_id !=null, new CouponResorce(Coupon::find($this->coupon_id))),//$this->when($this->coupon_id !=null,$this->coupon->code),
            "delivery_status" => $this->delivery_status,
            "delivery_mobile" => $this->when($this->delivery_id != null, $this->delivery->mobile),
            "payment_method" => $this->payment_method,
            'order_details' => UserOrderDetailsResource::collection($details),
            "sub_total" => $this->orderDetails()->sum('sub_total'),
            "total_discount" => $this->total_discount,
            "total" => $this->total
        ];
    }
}
