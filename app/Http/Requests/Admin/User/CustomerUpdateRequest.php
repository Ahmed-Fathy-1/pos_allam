<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            "abn" => "nullable|unique:customers,abn,".$this->id,
            "mobile" => "required|unique:customers,mobile,".$this->id,
            'state' => "required",
            "city" => "required",
            'post_code' => ['required'/*, new PostalCode('AU')*/],
            "address" => "required|string"
        ];
    }
}
