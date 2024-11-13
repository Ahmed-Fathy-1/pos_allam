<?php

namespace App\Http\Requests\SuperAdmin\HomeCovers;

use Illuminate\Foundation\Http\FormRequest;

class HomeCoverRequest extends FormRequest
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
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
    
        return $rules;
    }
}
