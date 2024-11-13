<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            "name" => "required|string|max:100|unique:categories,name,".$this->id,
            "description" => "required|string",
            "file"  => "nullable|array",
            "file.*" => "nullable|mimes:jpg,jpeg,png|max:2048",
            "alts" => "nullable"

        ];
    }
}
