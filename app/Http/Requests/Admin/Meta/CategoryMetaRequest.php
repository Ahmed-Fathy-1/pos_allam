<?php

namespace App\Http\Requests\Admin\Meta;

use Illuminate\Foundation\Http\FormRequest;

class CategoryMetaRequest extends FormRequest
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
            "title" => "required|string|max:200",
            'slug_url' => "required|string|max:255|unique:categories,slug_url,".$this->id,
            'new_redirection' =>"nullable|string|max:255|different:slug_url|unique:categories,new_redirection,".$this->id,
            "canonical_url" => "nullable|url",
            "keyword" => "nullable",
            "description" => "nullable|string",
            "schema_data" => "nullable|string",
        ];
    }
}
