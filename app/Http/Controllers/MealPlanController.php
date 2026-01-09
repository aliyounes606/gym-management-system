<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealPlanController extends Controller
{
    // 1. عرض جدول الوجبات (الأدمن يرى الكل، والمتدرب يرى وجباته فقط)
    public function index() {
        if (auth()->user()->hasRole('admin')) {
            // إذا كان أدمن يجلب كل الوجبات
            $plans = MealPlan::with(['image', 'trainee'])->latest()->get();
        } else {
            // إذا كان متدرب يجلب وجباته هو فقط بناءً على id الخاص به
            $plans = MealPlan::where('user_id', auth()->id())
                             ->with(['image', 'trainee'])
                             ->latest()
                             ->get();
        }
        
        return view('meal_plans.index', compact('plans'));
    }

    // 2. عرض صفحة "إضافة وجبة"
    public function create() {
        $trainees = User::role('member')->get();
        return view('meal_plans.create', compact('trainees'));
    }

    // 3. حفظ الوجبة الجديدة
    public function store(Request $request) {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required',
            'user_id'     => 'required|exists:users,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $mealPlan = MealPlan::create([
            'name'        => $request->name,
            'description' => $request->description,
            'calories'    => $request->calories ?? 0,
            'price'       => $request->price ?? 0,
            'user_id'     => $request->user_id,
            'trainer_id'  => auth()->id(),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('meals', 'public');
            
            $mealPlan->image()->create([
                'path'     => $path, // التوافق مع جدول رفاقك
                'filename' => $request->file('image')->getClientOriginalName(),
            ]);
        }

        return redirect()->route('meal-plans.index')->with('success', 'تم إرسال التوصية للمتدرب بنجاح');
    }

    // 4. حذف الوجبة
    public function destroy(MealPlan $mealPlan) {
        if ($mealPlan->image) {
            Storage::disk('public')->delete($mealPlan->image->path);
            $mealPlan->image()->delete();
        }
        
        $mealPlan->delete();
        return back()->with('success', 'تم حذف التوصية بنجاح');
    }

    // 5. تعديل الوجبة
    public function edit(MealPlan $mealPlan) {
        $trainees = User::role('member')->get();
        return view('meal_plans.edit', compact('mealPlan', 'trainees'));
    }

    // 6. تحديث الوجبة (تم تعديل url إلى path و filename)
    public function update(Request $request, MealPlan $mealPlan) {
        $request->validate([
            'name'    => 'required',
            'user_id' => 'required|exists:users,id',
            'image'   => 'nullable|image|max:2048'
        ]);

        $mealPlan->update($request->only(['name', 'description', 'calories', 'price', 'user_id']));

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة من السيرفر ومن قاعدة البيانات
            if ($mealPlan->image) {
                Storage::disk('public')->delete($mealPlan->image->path);
                $mealPlan->image()->delete();
            }

            // تخزين الصورة الجديدة باستخدام الأسماء الصحيحة
            $file = $request->file('image');
            $path = $file->store('meals', 'public');
            
            $mealPlan->image()->create([
                'path'     => $path,
                'filename' => $file->getClientOriginalName(),
            ]);
        }

        return redirect()->route('meal-plans.index')->with('success', 'تم تحديث التوصية بنجاح');
    }
}