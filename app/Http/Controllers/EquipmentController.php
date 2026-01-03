<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
//use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;

//use App\Http\Requests\Admin\UpdateEquipmentRequest;

class EquipmentController extends Controller
{
    // عرض كل المعدات
    public function index()
    {
        $equipment = Equipment::all();
        return view('Equipment.index', compact('equipment'));
    }

    // عرض فورم إنشاء معدة جديدة
    public function create()
{    
    $categories=Category::all();
    return view('equipment.create',compact('categories'));
}


    // حفظ المعدة الجديدة
    public function store(StoreEquipmentRequest $request)
    {
        $validated = $request->validated();
        $equipment = Equipment::create($validated);

        $equipment->categories()->attach($request->categories);

        return redirect()->route('equipment.show', $equipment->id)
                         ->with('success','تم حفظ المعدة بنجاح');
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

        $categories=Category::all();
        return view('equipment.edit', compact('equipment','categories'));
    }

    // تحديث المعدة
    public function update(UpdateEquipmentRequest $request, $id)
    {
        $validated = $request->validated();

        $equipment = Equipment::findOrFail($id);
        $equipment->update($validated);

        $equipment->categories()->sync($request->categories);

        return redirect()->route('equipment.index')
                         ->with('success','تم تحديث المعدة بنجاح');
    }

    // حذف المعدة
    public function destroy($id)
    {
        Equipment::destroy($id);
        return redirect()->route('equipment.index')
                         ->with('success','تم حذف المعدة');
    }
}
