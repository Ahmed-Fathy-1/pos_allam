<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GeneralPaymentRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            "payment_type" => "required|in:0,1,2",
            "amount_paid" => "required|numeric|min:1",
            "total_due" => "nullable|numeric",
            "paid_at" => "nullable|date_format:Y-m-d H:i",
            'type' => "required|in:0,1",
        ];
    }
}
