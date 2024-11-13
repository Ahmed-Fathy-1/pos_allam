<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            "name" => "required|string|max:100|unique:categories,name",
            "description" => "required|string",
            "file"  => "required|array",
            "file.*" => "mimes:jpg,jpeg,png,webp|max:2048",
            "alts" => "nullable",
            "title" => "nullable|string|max:200",
            "canonical_url" => "nullable|url",
            "keyword" => "nullable",
            "description_meta" => "nullable|string",
            "schema_data" => "nullable|string",
        ];
    }
}
