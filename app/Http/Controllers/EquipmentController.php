<?php

namespace App\Http\Controllers;


use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
                // عرض جميع المعدات
        public function index()
    {
        $equipments = Equipment::all();                                            // جلب جميع المعدات
        return view('equipment.index', compact('equipments'));                     // عرض المعدات
    }

                //   إضافة معدة جديدة
    public function create()
    {
        return view('equipment.create');                                          // إضافة معدة
    }

                // حفظ المعدة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

                // إنشاء المعدات
        Equipment::create([
            'name' => $request->name,
            'status' => $request->status,
            'quantity' => $request->quantity,
        ]);

        return
          redirect()->route('equipment.index')->with('success', 'Equipment created successfully!');
    }

                // عرض تفاصيل المعدة
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);                                       // جلب المعدة حسب المعرف
        return view('equipment.show', compact('equipment'));                           // عرض تفاصيل المعدة
    }

                //   تعديل المعدة
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);                                        // جلب المعدة حسب المعرف
        return view('equipment.edit', compact('equipment'));                             //   تعديل المعدة
    }

                // تحديث المعدة
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $equipment = Equipment::findOrFail($id);                                         // جلب المعدة حسب المعرف
        $equipment->update([
            'name' => $request->name,
            'status' => $request->status,
            'quantity' => $request->quantity,
        ]);

        return 
         redirect()->route('equipment.index')->with('success', 'Equipment updated successfully!');
    }

               // حذف المعدة
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);                                  // جلب المعدة حسب المعرف
        $equipment->delete();                                                      // حذف المعدة

        return 
         redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully!');
    }
}

      

