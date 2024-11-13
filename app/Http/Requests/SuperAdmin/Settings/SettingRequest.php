<?php

namespace App\Http\Requests\SuperAdmin\Settings;

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
            'image' => 'sometimes|image|mimes:jpeg,webp,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'facebook_link' => 'required|string|max:500',
            'twitter_link' => 'required|string|max:500',
            'whatsapp_link' => 'required|string|max:500',
            'pinterest_link' => 'required|string|max:500',
            'youtube_link' => 'required|string|max:500',
            'instagram_link' => 'required|string|max:500',
            'reddit_link' => 'required|string|max:500',
            'linkedin_link' => 'required|string|max:500',
            'footer_image' => 'sometimes|image|mimes:jpeg,webp,png,jpg,gif|max:2048',
            'desc' => 'required',
            'copyright' => 'required|string|max:500',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ];
    }
}
