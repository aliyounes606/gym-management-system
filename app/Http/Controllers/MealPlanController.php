<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    // 1. عرض جدول الوجبات فقط
    public function index() {
        $plans = MealPlan::all();
        return view('meal_plans.index', compact('plans'));
    }

    // 2. عرض صفحة "إضافة وجبة جديدة" (الفورم)
    public function create() {
        return view('meal_plans.create');
    }

    // 3. حفظ الوجبة الجديدة
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'calories' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        MealPlan::create($request->all());
        
   
        return redirect()->route('meal-plans.index')->with('success', 'تمت إضافة الوجبة بنجاح');
    }

    
    public function destroy(MealPlan $mealPlan) {
        $mealPlan->delete();
        return back()->with('success', 'تم حذف الوجبة');
    }

    public function edit(MealPlan $mealPlan) {
        return view('meal_plans.edit', compact('mealPlan'));
    }

    public function update(Request $request, MealPlan $mealPlan) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'calories' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $mealPlan->update($request->all());
        return redirect()->route('meal-plans.index')->with('success', 'تم تحديث الوجبة بنجاح');
    }
}