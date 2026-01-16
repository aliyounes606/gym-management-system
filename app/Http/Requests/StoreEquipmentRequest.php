<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
{
    /**
     * determines whether the authenticated user is allowed to create new equipment records.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * defines validation rules for storing new equipment.
     * 
     * validates name, status, quantity, and optional image upload.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
             'name'  => 'required|string|max:255',
            'status' => 'nullable|string',
            'quantity'=>'nullable|integer',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,gif',
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
