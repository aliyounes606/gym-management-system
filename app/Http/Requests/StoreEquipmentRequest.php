<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
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
             'name'  => 'required|string|max:255',
            'status' => 'nullable|string',
            'quantity'=>'nullable|integer',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

     public function storeImage($equipment)
    {
        if ($this->hasFile('image')){
            $path=$this->file('image')->store('public/equipment_images');
            $equipment->image()->create(['path'=>$path,]);
        }
    }
}
