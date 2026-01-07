<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required_if:booking_type,session|exists:gymsessions,id|nullable',
            'course_id' => 'required_if:booking_type,course|exists:courses,id|nullable',
            'booking_type' => 'required|in:session,course',
            'payment_status' => 'nullable|in:paid,unpaid',
            'amount_paid' => 'required|numeric|min:0',
            'attendance_status' => 'nullable|boolean',
        ];
    }
}
