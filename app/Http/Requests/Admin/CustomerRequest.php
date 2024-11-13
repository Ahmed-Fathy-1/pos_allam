<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            "name" => "required|string|max:100",
            "mobile" => "required|string|min:3|max:40|unique:customers,mobile",
            'abn' =>"nullable|string|min:3|max:40|unique:customers,abn",
            'state' => "required",
            "city" => "required",
            'post_code' => "required",
            "address" => "required|string"
        ];
    }
}
