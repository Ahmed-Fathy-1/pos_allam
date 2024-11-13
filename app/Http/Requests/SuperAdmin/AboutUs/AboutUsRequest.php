<?php

namespace App\Http\Requests\SuperAdmin\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'intro_title' => 'required|string|max:255',
            'intro_desc' => 'required|string',

            'numbers_clients_title' => 'nullable|string|max:255',
            'numbers_clients_count' => 'nullable|string|min:0',
            'numbers_downloads_title' => 'nullable|string|max:255',
            'numbers_downloads_count' => 'nullable|string|min:0',
            'numbers_projects_title' => 'nullable|string|max:255',
            'numbers_projects_count' => 'nullable|string|min:0',

            'workflow_title' => 'nullable|string|max:255',
            'workflow_desc' => 'nullable|string',
            'workflow_download_title' => 'nullable|string|max:255',
            'workflow_download_desc' => 'nullable|string',
            'workflow_download_number' => 'nullable|integer|min:0',
            'workflow_download_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'workflow_manage_title' => 'nullable|string|max:255',
            'workflow_manage_desc' => 'nullable|string',
            'workflow_manage_number' => 'nullable|integer|min:0',
            'workflow_manage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'workflow_edit_title' => 'nullable|string|max:255',
            'workflow_edit_desc' => 'nullable|string',
            'workflow_edit_number' => 'nullable|integer|min:0',
            'workflow_edit_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
