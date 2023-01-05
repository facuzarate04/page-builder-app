<?php

namespace App\Http\Requests\Dashboard\PageSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageHeaderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:page_headers,id',
            'title' => 'required|string|max:80',
            'subtitle' => 'required|string|max:180',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'avatar_is_active' => 'required|boolean',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_is_active' => 'required|boolean',
        ];
    }
}
