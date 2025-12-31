<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Image;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    // عرض جميع المعدات في الواجهة الرئيسية (Dashboard)
    public function dashboard()
    {
        // جلب جميع المعدات
        $equipments = Equipment::all();
        
        // عرض المعدات كـ HTML داخل Response
        $html = '<h1>Welcome to the Dashboard</h1>';
        $html .= '<h2>Manage Equipment</h2>';
        $html .= '<table border="1"><tr><th>Name</th><th>Status</th><th>Quantity</th><th>Actions</th></tr>';

        // تكرار البيانات لعرضها في الجدول
        foreach ($equipments as $equipment) {
            $html .= '<tr>';
            $html .= '<td>' . $equipment->name . '</td>';
            $html .= '<td>' . $equipment->status . '</td>';
            $html .= '<td>' . $equipment->quantity . '</td>';
            $html .= '<td>';
            $html .= '<a href="' . route('equipment.show', $equipment->id) . '">View</a> ';
            $html .= '<a href="' . route('equipment.edit', $equipment->id) . '">Edit</a> ';
            $html .= '<form action="' . route('equipment.destroy', $equipment->id) . '" method="POST" style="display:inline;">';
            $html .= '@csrf @method("DELETE")';
            $html .= '<button type="submit">Delete</button>';
            $html .= '</form>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // إرجاع الـ HTML مباشرة كـ Response
        return response($html);
    }

    // عرض المعدات
    public function index()
    {
        $equipments = Equipment::all();  // جلب جميع المعدات
        return view('equipment.index', compact('equipments'));  //   عرض المعدات
    }

    // عرض نموذج إضافة معدة جديدة
    public function create()
    {
        return view('equipment.create');  //   إضافة معدة
    }

    // حفظ المعدة الجديدة مع الصور
    public function store(Request $request)
    {
        // التحقق من البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'images' => 'required|array',  // التحقق من الصور
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',  // التحقق من نوع الصور
        ]);

        // إنشاء المعدات
        $equipment = Equipment::create([
            'name' => $request->name,
            'status' => $request->status,
            'quantity' => $request->quantity,
        ]);

        // إضافة الصور للمعدة
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');  // حفظ الصورة
                $equipment->images()->create(['path' => $path]);  // إضافة الصورة
            }
        }

        return redirect()->route('equipment.index')->with('success', 'Equipment created successfully!');
    }

    // عرض تفاصيل المعدة
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);  // جلب المعدة حسب المعرف
        return view('equipment.show', compact('equipment'));  // عرض تفاصيل المعدة
    }

    //   تعديل المعدة
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);  // جلب المعدة حسب المعرف
        return view('equipment.edit', compact('equipment'));  //   تعديل المعدة
    }

    // تحديث المعدة
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $equipment = Equipment::findOrFail($id);  // جلب المعدة حسب المعرف
        $equipment->update([
            'name' => $request->name,
            'status' => $request->status,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully!');
    }
    
    // حذف المعدة
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);  // جلب المعدة حسب المعرف
        $equipment->delete();  // حذف المعدة

        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully!');
    }
}