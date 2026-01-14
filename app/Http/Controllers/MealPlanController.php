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
        $plans = MealPlan::with(['image'])->latest()->paginate(10);
        $trainees = User::role('member')->get();

        return view('meal_plans.index', compact('plans', 'trainees'));
    }

    // 2. عرض الوجبات الموصى بها للمتدرب (خاص بالمتدرب)
    public function myRecommendedMeals()
    {
        // جلب التوصيات للمستخدم المسجل حالياً فقط مع بيانات الوجبة والمدرب
        $recommendations = MealRecommendation::with(['mealPlan.image', 'trainer'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('meal_plans.my_recommended', compact('recommendations'));
    }

    public function create() {
        return view('meal_plans.create');
    }

    public function store(StoreMealPlanRequest $request) 
    {
        $mealPlan = MealPlan::create([
            'name'        => $request->name,
            'description' => $request->description,
            'calories'    => $request->calories ?? 0,
            'price'       => $request->price ?? 0,
            'trainer_id'  => auth()->id(), 
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('meals', 'public');
            $mealPlan->image()->create([
                'path' => $path,
            ]);
        }

        return redirect()->route('meal-plans.index')->with('success', 'تمت إضافة الوجبة للمكتبة بنجاح');
    }

    public function recommend(Request $request)
    {
        $request->validate([
            'user_ids'     => 'required|array',
            'user_ids.*'   => 'exists:users,id',
            'meal_plan_id' => 'required|exists:meal_plans,id',
        ]);

        foreach ($request->user_ids as $userId) {
            MealRecommendation::firstOrCreate([
                'user_id'      => $userId,
                'meal_plan_id' => $request->meal_plan_id,
                'trainer_id'   => auth()->id(),
            ]);
        }

        return back()->with('success', 'تم إرسال التوصية للمتدربين بنجاح');
    }

    public function destroy(MealPlan $mealPlan) {
        if ($mealPlan->image) {
            Storage::disk('public')->delete($mealPlan->image->path);
            $mealPlan->image()->delete();
        }
        
        $mealPlan->delete();
        return back()->with('success', 'تم حذف الوجبة بنجاح');
    }

    public function edit(MealPlan $mealPlan) {
        return view('meal_plans.edit', compact('mealPlan'));
    }

    public function update(StoreMealPlanRequest $request, MealPlan $mealPlan) {
        $mealPlan->update($request->only(['name', 'description', 'calories', 'price']));

        if ($request->hasFile('image')) {
            if ($mealPlan->image) {
                Storage::disk('public')->delete($mealPlan->image->path);
                $mealPlan->image()->delete();
            }

            $path = $request->file('image')->store('meals', 'public');
            $mealPlan->image()->create(['path' => $path]);
        }

        return redirect()->route('meal-plans.index')->with('success', 'تم تحديث الوجبة بنجاح');
    }
    
public function show(MealPlan $mealPlan)
{
   
    $mealPlan->load('image');
    
    return view('meal_plans.show', compact('mealPlan'));
}
}