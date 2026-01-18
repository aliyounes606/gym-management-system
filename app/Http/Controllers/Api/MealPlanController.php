<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MealPlanService; 
use App\Traits\ApiResponseTrait; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MealPlanController extends Controller
{
    use ApiResponseTrait; 

    /**
     * @var MealPlanService
     */
    protected MealPlanService $mealPlanService; 

    /**
     * MealPlanController constructor.
     * * @param MealPlanService $mealPlanService
     */
    public function __construct(MealPlanService $mealPlanService)
    {
        $this->mealPlanService = $mealPlanService;
    }

    /**
     * Display a listing of all meal plans (General Library).
     * * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->mealPlanService->getAllMeals();
    }

    /**
     * Get the meal plans recommended for the authenticated trainee.
     * * @return \Illuminate\Http\JsonResponse
     */
    public function myPlans()
    {
        return $this->mealPlanService->getTraineePlans(auth()->id());
    }

    /**
     * Recommend a meal plan to multiple users.
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meal_plan_id' => 'required|exists:meal_plans,id',
            'user_ids'     => 'required|array',
            'user_ids.*'   => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation Error', 422, $validator->errors());
        }

        return $this->mealPlanService->recommendMealToUsers(
            $request->meal_plan_id,
            $request->user_ids,
            auth()->id()
        );
    }
}