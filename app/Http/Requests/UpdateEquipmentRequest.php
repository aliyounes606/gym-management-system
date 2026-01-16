<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentRequest extends FormRequest
{
    /**
     * determines whether the authenticated user is allowed to update equipment records.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * defines validation rules for updating equipment data.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
             'name'        => 'required|string|max:255',
            'status' => 'nullable|string',
            'quantity'=>'nullable|integer',
        ];
    }
}
