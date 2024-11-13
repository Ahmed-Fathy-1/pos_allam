<?php

namespace App\Http\Requests\Api\checkout;

use Axlon\PostalCodeValidation\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddress extends FormRequest
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
            'state' => "required",
            "city" => "required",
            'post_code' => ['required'/*, new PostalCode('AU')*/],
            "address" => "required|string"
        ];
    }
}
