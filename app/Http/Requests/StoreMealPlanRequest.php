<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealPlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
public function authorize(): bool
{
    return auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('trainer'));
}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules(): array
{
    return [
       
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'calories'    => 'nullable|integer',
        'price'       => 'nullable|numeric', 
        'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];
}}
