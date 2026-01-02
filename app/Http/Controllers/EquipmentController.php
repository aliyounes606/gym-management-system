<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
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
    return view('equipment.create');
}


    // حفظ المعدة الجديدة
    public function store(StoreEquipmentRequest $request)
    {
        $validated = $request->validated();
        $equipment = Equipment::create($validated);

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
        return view('equipment.edit', compact('equipment'));
    }

    // تحديث المعدة
    public function update(UpdateEquipmentRequest $request, $id)
    {
        $validated = $request->validated();

        $equipment = Equipment::findOrFail($id);
        $equipment->update($validated);

        return redirect()->route('Equipment.index')
                         ->with('success','تم تحديث المعدة بنجاح');
    }

    // حذف المعدة
    public function destroy($id)
    {
        Equipment::destroy($id);
        return redirect()->route('Equipment.index')
                         ->with('success','تم حذف المعدة');
    }
}
