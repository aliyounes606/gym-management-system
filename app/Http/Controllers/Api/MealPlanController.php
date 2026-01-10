<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use App\Models\MealRecommendation; 
use App\Http\Resources\MealPlanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MealPlanController extends Controller
{
    // 1. جلب كل الوجبات (المكتبة العامة)
    public function index()
    {
        $meals = MealPlan::with('image')->latest()->get();
        return MealPlanResource::collection($meals);
    }

    // 2. جلب الوجبات الخاصة بالمتدرب (التي أوصى بها المدرب)
    public function myPlans()
    {
        // المنطق الجديد: نبحث في جدول التوصيات عن ID المستخدم الحالي
        $recommendations = MealRecommendation::where('user_id', auth()->id())
            ->with('mealPlan.image') 
            ->get()
            ->pluck('mealPlan');

        return MealPlanResource::collection($recommendations);
    }

    // 3. دالة الإرسال للمتدربين (الاختيار المتعدد) عبر الـ API
    public function recommend(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'meal_plan_id' => 'required|exists:meal_plans,id',
            'user_ids'     => 'required|array', 
            'user_ids.*'   => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $mealPlanId = $request->meal_plan_id;
        $trainerId = auth()->id();

        // تنفيذ التوصية لكل متدرب تم اختياره
        foreach ($request->user_ids as $userId) {
            MealRecommendation::firstOrCreate([
                'user_id'      => $userId,
                'meal_plan_id' => $mealPlanId,
                'trainer_id'   => $trainerId,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال الوجبات للمتدربين بنجاح'
        ], 201);
    }
}