<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use App\Models\MealRecommendation; 
use App\Http\Resources\MealPlanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class MealPlanController extends Controller
{
    // 1. جلب كل الوجبات (المكتبة العامة)
    /** 
     * Get a listing of all meal plans from the general library
     * Returns a collection of meal plans with their images as an API resource
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try {
            $meals = MealPlan::with('image')->latest()->get();
            return MealPlanResource::collection($meals);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء جلب المكتبة العامة: ' . $e->getMessage()
            ], 500);
        }
    }

    // 2. جلب الوجبات الخاصة بالمتدرب (التي أوصى بها المدرب)
    /**
     * Retrieve the specific meal plans recommended for the authenticated trainee
     * Filters through recommendations to provide only the associated meal plan data
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function myPlans()
    {
        try {
            $recommendations = MealRecommendation::where('user_id', auth()->id())
                ->with('mealPlan.image') 
                ->get()
                ->pluck('mealPlan')
                ->filter(); 

            return MealPlanResource::collection($recommendations);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء جلب وجباتك: ' . $e->getMessage()
            ], 500);
        }
    }

    // 3. دالة الإرسال للمتدربين (الاختيار المتعدد) عبر الـ API
    /**
     * Assign a specific meal plan to multiple trainees 
     * Uses database transactions to ensure data integrity during mass insertion
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommend(Request $request)
    {
        try {
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

            // استخدام DB Transaction لضمان حفظ كل التوصيات أو عدم حفظ أي منها في حال الخطأ
            DB::beginTransaction();

            $mealPlanId = $request->meal_plan_id;
            $trainerId = auth()->id();

            foreach ($request->user_ids as $userId) {
                MealRecommendation::firstOrCreate([
                    'user_id'      => $userId,
                    'meal_plan_id' => $mealPlanId,
                    'trainer_id'   => $trainerId,
                ]);
            }

            DB::commit(); // اعتماد الحفظ

            return response()->json([
                'status' => 'success',
                'message' => 'تم إرسال الوجبات للمتدربين بنجاح'
            ], 201);

        } catch (Exception $e) {
            DB::rollBack(); // التراجع عن العمليات في حال حدوث خطأ أثناء الـ loop
            return response()->json([
                'status' => 'error',
                'message' => 'فشلت عملية الإرسال: ' . $e->getMessage()
            ], 500);
        }
    }
}