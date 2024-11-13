<?php

namespace App\Http\Requests\SuperAdmin\Packages;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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

        $packageId = $this->route('package');
        return [
            'title' => 'required|min:3|max:50|unique:packages,title,' . $packageId,
            'description' => 'required|min:3|max:255',
            'free' => 'nullable|boolean',
            'free_period' => 'nullable|integer|min:0',
            'Price_monthly' => 'required|min:2|integer',
            'Price_annually' => 'required|min:2|integer',
            'storage_monthly' => 'required|min:2|numeric',
            'storage_annually' => 'required|min:2|numeric',
            //  'interactive_archives' => 'required|in:Limited,Included',
            //  'custom_branding' => 'required|in:Included,Not Included',
            // 'messages' => 'required|in:Included,Not Included',
            'notifications' => 'required|in:1,0',
            "main_show" => 'required|in:1,0',
            "main_search" => "required|in:1,0",
            'statics' => 'required|in:1,0',
        ];
    }
}
