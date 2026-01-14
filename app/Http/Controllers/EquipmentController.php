<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $equipment = Equipment::with('image')->paginate(10);
        return view('equipment.index', compact('equipment'));
    }
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('equipment.create', compact('categories'));
    }
    /**
     * Summary of store
     * @param \App\Http\Requests\StoreEquipmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEquipmentRequest $request)
    {
        $equipment = Equipment::create($request->validated());

        // حفظ الصورة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipment_images', 'public');

            $equipment->image()->create([
                'path' => $imagePath
            ]);
        }

        if ($request->categories) {
            $equipment->category()->attach($request->categories);
        }

        return redirect()->route('equipment.index')
            ->with('success', 'تم حفظ المعدة بنجاح');
    }

    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $equipment = Equipment::with('category', 'image')->findOrFail($id);
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $equipment = Equipment::with('category', 'image')->findOrFail($id);
        $categories = Category::all();
        return view('equipment.edit', compact('equipment', 'categories'));
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\UpdateEquipmentRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEquipmentRequest $request, $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->validated());

        // تحديث الصورة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image->path);
                $equipment->image()->delete();
            }

            // رفع الصورة الجديدة
            $imagePath = $request->file('image')->store('equipment_images', 'public');

            $equipment->image()->create([
                'path' => $imagePath
            ]);
        }

        if ($request->categories) {
            $equipment->category()->sync($request->categories);
        }

        return redirect()->route('equipment.index')
            ->with('success', 'تم تحديث المعدة بنجاح');
    }

    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);

        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image->path);
            $equipment->image()->delete();
        }

        $equipment->delete();
        return redirect()->route('equipment.index')
            ->with('success', 'تم حذف المعدة');
    }
}
