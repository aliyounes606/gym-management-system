<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use  App\Models\GymSession;
class StoreSessionRequest extends FormRequest
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
           'title' => 'required|string|max:255',
            'trainer_profile_id' => 'nullable|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'single_price' => 'required|numeric',
            'max_capacity' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
// add more validation for session time 
    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if ($this->trainer_profile_id) {
            $conflict = GymSession::where('trainer_profile_id', $this->trainer_profile_id)
                ->where(function($q) {
                    $q->whereBetween('start_time', [$this->start_time, $this->end_time])
                      ->orWhereBetween('end_time', [$this->start_time, $this->end_time]);
                })
                ->exists();

            if ($conflict) {
                $validator->errors()->add('start_time', 'المدرب لديه جلسة بنفس الوقت.');
            }
        }
    });}
}
