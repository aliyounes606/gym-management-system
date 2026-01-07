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
               'title' => 'string|max:255',
            'trainer_id' => 'nullable|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'single_price' => 'numeric',
            'max_capacity' => 'integer',
            'start_time' => 'date',
            'end_time' => 'date|after:start_time',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
}
