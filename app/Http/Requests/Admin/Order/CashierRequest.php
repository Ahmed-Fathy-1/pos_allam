<?php

namespace App\Http\Requests\Admin\Order;

use App\Rules\UnitRules;
use Illuminate\Foundation\Http\FormRequest;

class CashierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "customer_id" => "required",
            "address_id" => "nullable|exists:addresses,id",
            "delivery_id" => "nullable|exists:users,id",
            'orders' => ['required', 'array', new UnitRules],
            "orders.*.product_id" => "required|exists:products,id",
            "orders.*.quantity" => "required|numeric|min:1",
            "orders.*.unit" => "required|numeric|exists:units,id",
            "orders.*.new_price" => "nullable|numeric|min:1"
        ];
    }
}
