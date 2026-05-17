<?php

namespace Modules\Tool\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStockToolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'tool_id' => 'required|exists:tools,id',
            'to_location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:1',
            // 'movement_type_id' => 'required|exists:movement_types,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
