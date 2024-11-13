<?php

namespace App\Http\Requests\Api\cart;

use Illuminate\Foundation\Http\FormRequest;

class CartStorageRequest extends FormRequest
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
           'cart_details' => 'required|array',
            'cart_details.*.product_id' => 'required|exists:products,id',
            'cart_details.*.quantity' => 'required|integer',

        ];
    }
}
