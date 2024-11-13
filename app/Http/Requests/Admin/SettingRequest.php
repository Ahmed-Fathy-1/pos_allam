<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            "site_name" => "required|string|max:50",
            "logo" => "nullable|mimes:png,jpg,jpeg,webp|max:2048",
            "open_today" => "required|string",
            "mobile" => "required|string",
            "abn" => "required",
            "email" => "required|email",
            "facebook_link" => "nullable|url",
            "instagram_link" => "nullable|url",
            "twitter_link" => "nullable|url",
//            "post_code" => "required|string",
            "shipping" => "nullable|numeric",
            "address" => "required|string|max:250",
            "amount_remove" => "required"
        ];
    }
}
