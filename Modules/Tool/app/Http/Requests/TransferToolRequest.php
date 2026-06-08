<?php

namespace Modules\Tool\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @property-read int $tool_id Tool to transfer.
 * @property-read int $from_location_id Source location.
 * @property-read int $to_location_id Destination location.
 * @property-read int $quantity Quantity to transfer.
 */
class TransferToolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'tool_id' => 'required|exists:tools,id',
            'from_location_id' => 'required|exists:locations,id',
            'to_location_id' => 'required|exists:locations,id|different:from_location_id',
            'quantity' => 'required|integer|min:1',
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
