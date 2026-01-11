<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreSingleBookingRequest extends FormRequest
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
            'session_id' => ['required', 'integer', 'exists:gymsessions,id'],
        ];
    }
    public function messages()
    {
        return [
            'session_id.required' => 'يرجى اختيار الجلسة المطلوبة.',
            'session_id.exists' => 'الجلسة المختارة غير موجودة في النظام.',
        ];
    }
}
