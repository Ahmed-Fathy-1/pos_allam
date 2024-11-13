<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" => "required|string|max:200|unique:products,name,".$this->id,
            "category_id" => "required|exists:categories,id",
            "description" => "required|string",
            "file" => "required_without:id|array|max:2",
            "file.*" => "required_without:id|mimes:jpg,jpeg,png,webp",
            "alts" => "nullable|string",
            'prices.*.unit_id' => 'required|exists:units,id|distinct',
            'prices.*.price' => 'required|numeric|min:0',
            'prices.*.stock' => 'required|numeric|min:0',
            "prices.*.discount" => "nullable|numeric|min:1",
            'prices.*.gst' => "nullable|numeric|min:1",
            "title" => "nullable|string|max:200",
            "canonical_url" => "nullable|url",
            "keyword" => "nullable",
            "description_meta" => "nullable|string",
            "schema_data" => "nullable|string",
            //special prices
            "special_prices.*.customer_id" => "nullable|exists:customers,id",
            "special_prices.*.unit_id" => "nullable|exists:customers,id",
            "special_prices.*.price" => "nullable|numeric|min:0",
        ];
    }

    public function messages()
    {
        return [
            "prices.*.unit_id.distinct" => "You Select Same Unit To Same Product , Please Select different"
        ];
    }
}
