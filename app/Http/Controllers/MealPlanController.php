<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\User;
use App\Models\MealRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMealPlanRequest;

class MealPlanController extends Controller
{
    // 1. عرض جدول الوجبات (مكتبة الوجبات العامة)
    public function index() {
        // هنا نعرض كل الوجبات المضافة للمكتبة مع صورها
        $plans = MealPlan::with(['image'])->latest()->get();
        
        // جلب المستخدمين الذين يحملون رتبة متدرب فقط
        $trainees = User::role('member')->get();

        return view('meal_plans.index', compact('plans', 'trainees'));
    }

    // 2. عرض صفحة "إضافة وجبة"
    public function create() {
        return view('meal_plans.create');
    }

    // 3. حفظ الوجبة في المكتبة
    public function store(StoreMealPlanRequest $request) 
    {
        // إنشاء الوجبة كبيانات عامة في المكتبة
        $mealPlan = MealPlan::create([
            'name'        => $request->name,
            'description' => $request->description,
            'calories'    => $request->calories ?? 0,
            'price'       => $request->price ?? 0,
            'trainer_id'  => auth()->id(),
        ]);

        // معالجة رفع الصورة إن وجدت
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('meals', 'public');
            
            $mealPlan->image()->create([
                'path'     => $path,
                'filename' => $request->file('image')->getClientOriginalName(),
            ]);
        }

        return redirect()->route('meal-plans.index')->with('success', 'تمت إضافة الوجبة للمكتبة بنجاح');
    }

    // التعديل الجديد: إرسال الوجبة لعدة متدربين في وقت واحد
    public function recommend(Request $request)
    {
        // التحقق من صحة البيانات (نتوقع مصفوفة من الـ user_ids)
        $request->validate([
            'user_ids'     => 'required|array',
            'user_ids.*'   => 'exists:users,id',
            'meal_plan_id' => 'required|exists:meal_plans,id',
        ]);

        $mealPlanId = $request->meal_plan_id;
        $trainerId = auth()->id();

        // عمل دوران على كل المتدربين المختارين
        foreach ($request->user_ids as $userId) {
            // استخدام firstOrCreate لمنع تكرار نفس الوجبة لنفس المتدرب
            MealRecommendation::firstOrCreate([
                'user_id'      => $userId,
                'meal_plan_id' => $mealPlanId,
                'trainer_id'   => $trainerId,
            ]);
        }

        return back()->with('success', 'تم إرسال التوصية لجميع المتدربين المختارين بنجاح');
    }

    // 4. حذف وجبة من المكتبة
    public function destroy(MealPlan $mealPlan) {
        if ($mealPlan->image) {
            Storage::disk('public')->delete($mealPlan->image->path);
            $mealPlan->image()->delete();
        }
        
        $mealPlan->delete();
        return back()->with('success', 'تم حذف الوجبة من المكتبة بنجاح');
    }

    // 5. تعديل بيانات وجبة
    public function edit(MealPlan $mealPlan) {
        return view('meal_plans.edit', compact('mealPlan'));
    }

    public function update(Request $request, MealPlan $mealPlan) {
        $request->validate([
            'name'  => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        // تحديث البيانات الأساسية
        $mealPlan->update($request->only(['name', 'description', 'calories', 'price']));

        // تحديث الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            if ($mealPlan->image) {
                Storage::disk('public')->delete($mealPlan->image->path);
                $mealPlan->image()->delete();
            }

            $file = $request->file('image');
            $path = $file->store('meals', 'public');
            
            $mealPlan->image()->create([
                'path'     => $path,
                'filename' => $file->getClientOriginalName(),
            ]);
        }

        return redirect()->route('meal-plans.index')->with('success', 'تم تحديث بيانات الوجبة بنجاح');
    }
}