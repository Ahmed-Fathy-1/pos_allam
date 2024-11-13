<?php

namespace App\Http\Requests\SuperAdmin\Features;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
            'main_title' => 'required|string|max:255',
            'main_description' => 'required|string',
            'feature_1_title' => 'required|string|max:255',
            'feature_1_description' => 'required|string',
            'feature_1_image' => 'nullable|image|mimes:jpeg,png,svg,jpg,gif|max:2048',
            'feature_2_title' => 'required|string|max:255',
            'feature_2_description' => 'required|string',
            'feature_2_image' => 'nullable|image|mimes:jpeg,png,svg,jpg,gif|max:2048',
            'feature_3_title' => 'required|string|max:255',
            'feature_3_description' => 'required|string',
            'feature_3_image' => 'nullable|image|mimes:jpeg,png,svg,jpg,gif|max:2048',
        ];
    }
}
