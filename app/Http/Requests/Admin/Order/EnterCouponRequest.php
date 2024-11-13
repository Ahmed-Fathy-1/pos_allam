<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class EnterCouponRequest extends FormRequest
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
            "code" => "required|string|max:50|unique:coupons,code,".$this->id,
            "limit" => "required|integer|min:1",
            "discount" => "required|integer|min:1",
            "start_at" => "required|date_format:Y-m-d H:i",
            "end_at" => "required|date_format:Y-m-d H:i|after:start_at",
            "status" => "nullable"
        ];
    }
}
