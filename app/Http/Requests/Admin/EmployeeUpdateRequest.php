<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            "name" => "required|string|max:100|min:3",
            "email" => "required|email|unique:users,email,".$this->id,
            "mobile" => "required|string|max:40|min:3|unique:users,mobile,".$this->id,
            "password" => "nullable|string|max:200|min:6|confirmed",
            "role_name" => "required|exists:roles,name",
            "image" => "nullable|image|max:2048"
        ];
    }
}
