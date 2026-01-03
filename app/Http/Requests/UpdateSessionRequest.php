<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
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
            //
               'title' => 'sometimes|string|max:255',
            'trainer_id' => 'sometimes|exists:users,id',
            'course_id' => 'sometimes|exists:courses,id',
            'single_price' => 'sometimes|numeric',
            'max_capacity' => 'sometimes|integer',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
}
