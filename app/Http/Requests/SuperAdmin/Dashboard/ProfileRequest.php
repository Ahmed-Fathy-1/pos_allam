<?php

namespace App\Http\Requests\SuperAdmin\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "name" =>"required|string|max:200",
            'email' => 'required_without:id|email|max:255|unique:users,email,'. $this->id,
            "password" =>"nullable|string|min:6",
            "password_confirmation" =>"nullable|same:password",
            "image" =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
