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
        // حفظ بيانات المعدة
        $equipment = Equipment::create($request->validated());

        // حفظ الصورة إذا موجودة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipment_images', 'public');
            $equipment->image()->create([
                'path' => $imagePath,
                'filename' => basename($imagePath),
            ]);
        }

        // ربط التصنيفات
        if ($request->categories) {
            $equipment->categories()->attach($request->categories);
        }

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

        // تعديل الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            if ($equipment->image) {
                $equipment->image()->delete(); // حذف الصورة القديمة
            }
            $imagePath = $request->file('image')->store('equipment_images', 'public');
            $equipment->image()->create([
                'path' => $imagePath,
                'filename' => basename($imagePath),
            ]);
        }

        // تحديث التصنيفات
        if ($request->categories) {
            $equipment->categories()->sync($request->categories);
        }

        return redirect()->route('equipment.index')
                         ->with('success', 'تم تحديث المعدة بنجاح');
    }

    // حذف المعدة
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);

        // حذف الصورة المرتبطة إذا موجودة
        if ($equipment->image) {
            $equipment->image()->delete();
        }

        $equipment->delete();

        return redirect()->route('equipment.index')
                         ->with('success', 'تم حذف المعدة');
    }
}
