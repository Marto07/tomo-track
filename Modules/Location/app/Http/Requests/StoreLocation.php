<?php

namespace Modules\Location\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:300',
            'street' => 'nullable|string|max:100',
            'apartment' => 'nullable|string|max:50',
            'number' => 'nullable|integer',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'city_id' => 'nullable|exists:cities,id',
            'location_type_id' => 'nullable|exists:location_types,id',
        ];
    }

    public function messages(): array
    {
        return [];    
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $hasAddress =
                $this->street &&
                $this->number &&
                $this->city_id;

            $hasCoordinates =
                $this->latitude &&
                $this->longitude;

            if (!$hasAddress && !$hasCoordinates) {
                $validator->errors()->add(
                    'location',
                    'You must provide either a valid address (street, number, city_id) or valid coordinates (latitude and longitude).'
                );
            }
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
