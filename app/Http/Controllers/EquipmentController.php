<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;

class EquipmentController extends Controller
{
    // عرض كل المعدات
    public function index()
    {
        $equipment = Equipment::all();
        return view('equipment.index', compact('equipment'));
    }

    // عرض فورم إنشاء معدة جديدة
    public function create()
    {    
        $categories = Category::all();
        return view('equipment.create', compact('categories'));
    }

    // حفظ معدة جديدة
    public function store(StoreEquipmentRequest $request)
    { 
        $equipment = Equipment::create($request->validated());
        //حفظ الصورة إذا كانت موجودة
        if($request->hasFile('image')){
            $imagePath=$request->file('image')->store('equipment_images,public');
        $equipment->image()->create(['path'=>$imagePath,]);}     //'filename'=>basename($imagePath),
 
        if($request->categories){
        $equipment->categories()->attach($request->categories);}

        return redirect()->route('equipment.index', $equipment->id)
                         ->with('success', 'تم حفظ المعدة بنجاح');
    }

    // عرض معدة محددة
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('equipment.show', compact('equipment'));
    }

    // عرض فورم تعديل معدة
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        $categories = Category::all();
        return view('equipment.edit', compact('equipment', 'categories'));
    }

    // تحديث المعدة
    public function update(UpdateEquipmentRequest $request, $id)
    { 
        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->validated());
        //في حال تم إرسال صورة جديدة نقوم بنعديل الصورة
         if ($request->hasFile('image')){
           if($equipment->image){$equipment->image()->delete();}   
           $imagePath=$request->file('image')->store('equipment_images','public');  
           $equipment->image()->create(['path'=>$imagePath,'filename'=>basename($imagePath),]); 
        }

        if ($request->categories){
            $equipment->categories()->sync($request->categories);}

        return redirect()->route('equipment.index')
                         ->with('success', 'تم تحديث المعدة بنجاح');
    }

    // حذف المعدة
    public function destroy($id)
    {
        $equipment=Equipment::findOrFail($id);
        //حذف الصورة المرتبطة إذا كانت موجودة
        if($equipment->image){
            $equipment->image()->delete();
        }
        $equipment->delete();
        return redirect()->route('equipment.index')
                         ->with('success', 'تم حذف المعدة');
    }
}
