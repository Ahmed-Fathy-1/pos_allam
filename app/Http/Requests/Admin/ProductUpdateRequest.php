<?php

namespace App\Http\Requests\Admin;

use App\Rules\CustomerUnitId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductUpdateRequest extends FormRequest
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
        $productId = $this->id;
        return [
            "name" => "required|string|max:200|unique:products,name,".$this->id,
            "status" => "required",
            "category_id" => "required|exists:categories,id",
            "description" => "required|string",
            "file" => "required_without:id|array|max:2",
            "file.*" => "required_without:id|mimes:jpg,jpeg,png,webp|max:2048",
            "alts" => "nullable",
            'prices.*.unit_id' => 'required|exists:units,id|distinct',
            'prices.*.price' => 'nullable|numeric|min:1',
            "prices.*.discount" => "nullable|numeric|min:1",
            'prices.*.gst' => "nullable|numeric|min:1",

            //special prices
            "special_prices.*.customer_id" => "nullable|exists:customers,id",
            "special_prices.*.unit_id" => [
                "nullable",
                "exists:units,id",
            ],
            "special_prices.*.price" => "nullable|numeric|min:0",
        ];
    }

    public function messages()
    {
        return [
            "prices.*.unit_id.distinct" => "You Select Same Unit To Same Product , Please Select different",
            //"special_prices.*.unit_id.unique" => "The unit for this customer already exists. Please select a different unit.",
        ];
    }
}
