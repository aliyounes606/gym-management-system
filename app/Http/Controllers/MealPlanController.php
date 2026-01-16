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
    /**
     * Display a listing of all healthy meal plans
     * Fetches meal plans with their images and a list of trainees for recommendation
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        $plans = MealPlan::with(['image'])->latest()->paginate(10);
        $trainees = User::role('member')->get();

        return view('meal_plans.index', compact('plans', 'trainees'));
    }

    /**
     * Display the recommended meal plans for the currently authenticated trainee
     * Includes meal plan images and assigned trainer details
     * @return \Illuminate\Contracts\View\View
     */
    public function myRecommendedMeals()
    {
        // جلب التوصيات للمستخدم المسجل حالياً فقط مع بيانات الوجبة والمدرب
        $recommendations = MealRecommendation::with(['mealPlan.image', 'trainer'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('meal_plans.my_recommended', compact('recommendations'));
    }
    /**
     *  Show the form for creating a new meal plan
     * @return \Illuminate\Contracts\View\View
     */
    public function create() {
        return view('meal_plans.create');
    }
    /**
     * Store a newly created meal plan in the database
     * Handles image upload and associates the plan with the authenticated trainer
     * @param StoreMealPlanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
    /**
     * Recommend a specific meal plan to multiple trainees
     * Validates input and avoids duplicate recommendations using firstOrCreate
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
    /**
     * Remove the specified meal plan from storage
     * Also deletes the associated image file from physical storage
     * @param MealPlan $mealPlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MealPlan $mealPlan) {
        if ($mealPlan->image) {
            Storage::disk('public')->delete($mealPlan->image->path);
            $mealPlan->image()->delete();
        }
        
        $mealPlan->delete();
        return back()->with('success', 'تم حذف الوجبة بنجاح');
    }
    /**
     *Show the form for editing the specified meal plan
     * @param MealPlan $mealPlan
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(MealPlan $mealPlan) {
        return view('meal_plans.edit', compact('mealPlan'));
    }
    /**
     * Update the specified meal plan in database
     * Manages updating text fields and replacing the old image if a new one is uploaded
     * @param StoreMealPlanRequest $request
     * @param MealPlan $mealPlan
     * @return \Illuminate\Http\RedirectResponse
     */
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
/**
 * Display the details of a specific meal plan
 * Eager loads the image relationship for optimal performance
 * @param MealPlan $mealPlan
 * @return \Illuminate\Contracts\View\View
 */
public function show(MealPlan $mealPlan)
{
   
    $mealPlan->load('image');
    
    return view('meal_plans.show', compact('mealPlan'));
}
}