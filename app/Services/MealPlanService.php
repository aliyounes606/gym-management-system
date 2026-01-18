<?php

namespace App\Services;

use App\Models\MealPlan;
use App\Models\MealRecommendation;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class MealPlanService
{
    use ApiResponseTrait;

    /**
     * Get all meal plans from the general library
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllMeals()
    {
        try {
            $meals = MealPlan::with('image')->latest()->get();
            return $this->successResponse($meals, 'تم جلب المكتبة العامة بنجاح');
        } catch (Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء جلب المكتبة العامة: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get recommended meal plans for a specific trainee
     * @param mixed $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTraineePlans($userId)
    {
        try {
            $recommendations = MealRecommendation::where('user_id', $userId)
                ->with('mealPlan.image')
                ->get()
                ->pluck('mealPlan')
                ->filter();

            return $this->successResponse($recommendations, 'تم جلب وجباتك بنجاح');
        } catch (Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء جلب وجباتك: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Assign a meal plan to multiple trainees
     * @param mixed $mealPlanId
     * @param array $userIds
     * @param mixed $trainerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommendMealToUsers($mealPlanId, array $userIds, $trainerId)
    {
        DB::beginTransaction();
        try {
            foreach ($userIds as $userId) {
                MealRecommendation::firstOrCreate([
                    'user_id'      => $userId,
                    'meal_plan_id' => $mealPlanId,
                    'trainer_id'   => $trainerId,
                ]);
            }
            DB::commit();
            return $this->successResponse([], 'تم إرسال الوجبات للمتدربين بنجاح', 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse('فشلت عملية الإرسال: ' . $e->getMessage(), 500);
        }
    }
}