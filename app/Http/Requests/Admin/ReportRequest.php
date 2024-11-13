<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "title" => "required|string|max:200",
            "type" => "required",
            "customer_id" =>"nullable|exists:customers,id",
            "start_date" => "required|date|before:end_date",
            "end_date" => "required|date|after:start_date|before_or_equal:today",
            "description" => "nullable|string"
        ];
    }
}
