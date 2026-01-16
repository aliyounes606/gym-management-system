<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Review;
use App\Models\MealPlan;
use App\Models\GymSession;
use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * this fuction for create a review by model type
     * @param Request $request
     * @param mixed $model
     * @param mixed $t
     * @return void
     */
    public function storeReview(Request $request, $model, &$t)
    {
        $data = $request->validate([
            
        ]);

        $t = $model->review()->create([
            'user_id' => Auth::user()->id,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);
    }

    /**
     * this fuction for review a course (api)
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function CourseReview(Request $request, Course $course)
    {
        try {
            $this->storeReview($request, $course, $t);
            return response()->json([
                'message' => 'تم تقييم الكورس',
                $t,
                'course' => $course->name
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء إضافة التقييم: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * this fuction for review a traine (api)
     * @param Request $request
     * @param TrainerProfile $trainer
     * @return \Illuminate\Http\JsonResponse
     */
    public function TrainerReview(Request $request, TrainerProfile $trainer)
    {
        $this->storeReview($request, $trainer, $t);
        return response()->json([
            'message' => 'تم تقييم المدرب',
            $t,
            'trainer' => $trainer->user_id
        ], 200);
    }

    /**
     * this funcion for review a meal plan (api)
     * @param Request $request
     * @param MealPlan $mealplan
     * @return \Illuminate\Http\JsonResponse
     */
    public function MealPlanReview(Request $request, MealPlan $mealplan)
    {
        $this->storeReview($request, $mealplan, $t);
        return response()->json([
            'message' => 'تم تقييم الخطة',
            $t,
            'mealplan' => $mealplan->name
        ], 200);
    }

    /**
     * this funcion for review a gym session (api)
     * @param Request $request
     * @param GymSession $gymsession
     * @return \Illuminate\Http\JsonResponse
     */
    public function GymSessionReview(Request $request, GymSession $gymsession)
    {
        if ($gymsession->course_id !== null) {
            return response()->json([
                'message' => 'لا يمكن تقيم الجلسات المنتمية لكورس'
            ], 403);
        }

        $this->storeReview($request, $gymsession, $t);
        return response()->json([
            'message' => 'تم تقييم الجلسة',
            $t,
            'gymsession' => $gymsession->title
        ], 200);
    }

    /**
     * this method for got to index pag and send data to it and git the top one (web)
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
{
    $reviews = Review::all();

    // ===== أفضل كورس =====
    $bestCourseId = Review::where('reviewable_type', 'course')
        ->selectRaw('reviewable_id')
        ->groupBy('reviewable_id')
        ->orderByRaw('AVG(rating) DESC')
        ->value('reviewable_id');

    $bestCourse = $bestCourseId
        ? Course::find($bestCourseId)
        : null;

    // ===== أفضل مدرب =====
    $bestTrainerId = Review::where('reviewable_type', 'trainer')
        ->selectRaw('reviewable_id')
        ->groupBy('reviewable_id')
        ->orderByRaw('AVG(rating) DESC')
        ->value('reviewable_id');

    $bestTrainer = $bestTrainerId
        ? TrainerProfile::find($bestTrainerId)
        : null;

    // ===== أفضل خطة =====
    $bestMealPlanId = Review::where('reviewable_type', 'mealplan')
        ->selectRaw('reviewable_id')
        ->groupBy('reviewable_id')
        ->orderByRaw('AVG(rating) DESC')
        ->value('reviewable_id');

    $bestMealPlan = $bestMealPlanId
        ? MealPlan::find($bestMealPlanId)
        : null;

    // ===== أفضل جلسة =====
    $bestGymSessionId = Review::where('reviewable_type', 'gymsession')
        ->selectRaw('reviewable_id')
        ->groupBy('reviewable_id')
        ->orderByRaw('AVG(rating) DESC')
        ->value('reviewable_id');

    $bestGymSession = $bestGymSessionId
        ? GymSession::find($bestGymSessionId)
        : null;

    return view('reviews.index', compact(
        'reviews',
        'bestCourse',
        'bestTrainer',
        'bestMealPlan',
        'bestGymSession'
    ));
}



    // all these fuctions going to reviews 
    public function GoToTrainerReviews()
    {
        $traniner_reviews = Review::with(['user', 'reviewable'])
            ->where('reviewable_type', 'trainer')
            ->get();

        return view('reviews.trainer_reviews', compact('traniner_reviews'));
    }

    public function GoToMealPlanReviews()
    {
        $mealplan = Review::with(['user', 'reviewable'])
            ->where('reviewable_type', 'mealplan')
            ->get();

        return view('reviews.mealplan_reviews', compact('mealplan'));
    }

    public function GoToGymSessionReviews()
    {
        $gym_session_reviews = Review::with(['user', 'reviewable'])
            ->where('reviewable_type', 'gymsession')
            ->get();

        return view('reviews.gym_session_reviews', compact('gym_session_reviews'));
    }

    public function GoToCourseReviews()
    {
        $course_reviews = Review::with(['user', 'reviewable'])
            ->where('reviewable_type', 'course')
            ->get();

        return view('reviews.course_reviews', compact('course_reviews'));
    }
}
