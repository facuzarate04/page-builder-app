<?php

namespace App\Http\Requests\Dashboard\PageSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpsertPageSocialLinksRequest extends FormRequest
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
            'platforms' => 'required|array',
            'platforms.*.id' => 'required|integer|exists:platforms,id',
            'platforms.*.username' => 'nullable|string|max:180'
        ];
    }
}
