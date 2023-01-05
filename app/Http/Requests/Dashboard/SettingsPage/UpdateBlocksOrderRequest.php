<?php

namespace App\Http\Requests\Dashboard\SettingsPage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlocksOrderRequest extends FormRequest
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
            'blocks' => 'required|array',
            'blocks.*' => 'required|array',
            'blocks.*.id' => 'required|exists:page_blocks,id',
            'blocks.*.order' => 'required|integer'
        ];
    }
}
