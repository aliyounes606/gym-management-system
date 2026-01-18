<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\Models\MealPlan;
use App\Models\GymSession;
use App\Models\TrainerProfile;
use App\Services\ReviewService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\Api\StoreReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    // ================== API Methods ==================

    /**
     * Summary of CourseReview
     * @param \App\Http\Requests\Api\StoreReviewRequest $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function CourseReview(StoreReviewRequest $request, Course $course)
    {
        try {
            $review = $this->reviewService->createReview($course, $request->validated());

            return $this->successResponse([
                'review' => $review,
                'course' => $course->name
            ], 'تم تقييم الكورس بنجاح');

        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء إضافة التقييم: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Summary of TrainerReview
     * @param \App\Http\Requests\Api\StoreReviewRequest $request
     * @param \App\Models\TrainerProfile $trainer
     * @return \Illuminate\Http\JsonResponse
     */
    public function TrainerReview(StoreReviewRequest $request, TrainerProfile $trainer)
    {
        try {
            $review = $this->reviewService->createReview($trainer, $request->validated());

            return $this->successResponse([
                'review' => $review,
                'trainer' => $trainer->user->name ?? $trainer->id
            ], 'تم تقييم المدرب بنجاح');

        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء تقييم المدرب', 500);
        }
    }

    /**
     * Summary of MealPlanReview
     * @param \App\Http\Requests\Api\StoreReviewRequest $request
     * @param \App\Models\MealPlan $mealplan
     * @return \Illuminate\Http\JsonResponse
     */
    public function MealPlanReview(StoreReviewRequest $request, MealPlan $mealplan)
    {
        try {
            $review = $this->reviewService->createReview($mealplan, $request->validated());

            return $this->successResponse([
                'review' => $review,
                'mealplan' => $mealplan->name
            ], 'تم تقييم الخطة بنجاح');

        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء تقييم الخطة', 500);
        }
    }

    /**
     * Summary of GymSessionReview
     * @param \App\Http\Requests\Api\StoreReviewRequest $request
     * @param \App\Models\GymSession $gymsession
     * @return \Illuminate\Http\JsonResponse
     */
    public function GymSessionReview(StoreReviewRequest $request, GymSession $gymsession)
    {
        if ($gymsession->course_id !== null) {
            return $this->errorResponse('لا يمكن تقييم الجلسات المنتمية لكورس، يرجى تقييم الكورس كاملاً', 403);
        }

        try {
            $review = $this->reviewService->createReview($gymsession, $request->validated());

            return $this->successResponse([
                'review' => $review,
                'gymsession' => $gymsession->title
            ], 'تم تقييم الجلسة بنجاح');

        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء تقييم الجلسة', 500);
        }
    }

    // ================== Web Methods (Views) ==================
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'reviews' => $this->reviewService->getAllReviews(),
            'bestCourse' => $this->reviewService->getBestRatedItem('course', Course::class),
            'bestTrainer' => $this->reviewService->getBestRatedItem('trainer', TrainerProfile::class),
            'bestMealPlan' => $this->reviewService->getBestRatedItem('mealplan', MealPlan::class),
            'bestGymSession' => $this->reviewService->getBestRatedItem('gymsession', GymSession::class),
        ];

        return view('reviews.index', $data);
    }

    public function GoToTrainerReviews()
    {
        $traniner_reviews = $this->reviewService->getReviewsByType('trainer');
        return view('reviews.trainer_reviews', compact('traniner_reviews'));
    }

    public function GoToMealPlanReviews()
    {
        $mealplan = $this->reviewService->getReviewsByType('mealplan');
        return view('reviews.mealplan_reviews', compact('mealplan'));
    }

    public function GoToGymSessionReviews()
    {
        $gym_session_reviews = $this->reviewService->getReviewsByType('gymsession');
        return view('reviews.gym_session_reviews', compact('gym_session_reviews'));
    }

    public function GoToCourseReviews()
    {
        $course_reviews = $this->reviewService->getReviewsByType('course');
        return view('reviews.course_reviews', compact('course_reviews'));
    }
}