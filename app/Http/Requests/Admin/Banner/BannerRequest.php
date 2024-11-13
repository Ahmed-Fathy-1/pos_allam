<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title'         => ['required', 'string', 'min:3' , 'max:255'],
            'description'   => ['required', 'string', 'min:3', 'max:1000'],
            'category_id'   => ['required', 'exists:categories,id'],
            'text_color'    => 'required|string|max:100',
            'image'         => 'required_without:id|nullable|image',
            "alt"           => "required|string|max:200"
        ];
    }
}
