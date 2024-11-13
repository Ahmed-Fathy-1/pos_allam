<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusOrderRequest extends FormRequest
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
            'status' => "nullable|in:0,1",
            "payment_status" => "nullable|in:0,1,2",
            "amount_paid" => "nullable|numeric|min:1",
            "paid_at" => "nullable|date_format:Y-m-d H:i"
        ];
    }
}
