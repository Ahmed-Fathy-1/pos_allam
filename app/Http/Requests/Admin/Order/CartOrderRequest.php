<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class CartOrderRequest extends FormRequest
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
            "customer_id" => "nullable",
            "address_id" => "nullable|exists:addresses,id",
            "delivery_id" => "nullable|exists:users,id",
            "created_at" => "nullable|date_format:Y-m-d H:i"
        ];
    }
}
