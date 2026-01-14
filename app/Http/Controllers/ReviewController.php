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

    // this mithode for review by morph relationship
    public function storeReview(Request $requset, $model,&$t) {

        $data = $requset->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string|max:1000',
        ]);
        $t = $model->review()->create([
           'user_id'=>Auth::user()->id,
           'rating'=>$requset->rating,
           'comment'=>$requset->comment,
        ]);
    }


        // review a Course

    public function CourseReview(Request $request,Course $course)
    {
        $this->storeReview($request,$course,$t);
        return response()->json(['message'=>'تم تقييم الكورس',$t]);
    }

    // review a trainer
    public function TrainerReview(Request $request,TrainerProfile $trainer)
    {
        $this->storeReview($request,$trainer,$t);
        return response()->json(['message'=>'تم تقييم المدرب',$t], 200);
    }

    // review a mealPlan
    public function MealPlanReview(Request $request,MealPlan $mealplan)
    {
        $this->storeReview($request,$mealplan,$t);
        return response()->json(['message'=>'تم تقييم الخطة'],$t);
    }

    public function GymSessionReview(Request $request,GymSession $gymsession)
    {
        if ($gymsession->course_id !== null)
        {
            return response()->json(['message'=>'لا يمكن تقيم الجلسات المنتمية لكورس'],403);
        }
        else {
            $this->storeReview($request,$gymsession,$t);
        return response()->json(['message'=>'تم تقييم الجسلة'],$t);
        }
    }

    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }
    public function show()
    {
        
    }

    public function GoToTrainerReviews()
    {

        $traniner_reviews = Review::with(['user', 'reviewable'])
        ->where( 'reviewable_type', 'trainer')
        ->get();
        return view('reviews.trainer_reviews', compact('traniner_reviews'));
    }

    public function GoToMealPlanReviews()
    {

        $mealplan = Review::with(['user', 'reviewable'])
        ->where( 'reviewable_type', 'mealplan')
        ->get();
        return view('reviews.mealplan_reviews', compact('mealplan'));
    }
    public function GoToGymSessionReviews()
    {
        $gym_session_reviews = Review::with(['user', 'reviewable'])
        ->where( 'reviewable_type', 'gymsession')
        ->get();
        return view('reviews.gym_session_reviews', compact('gym_session_reviews'));
    }
    public function GoToCourseReviews()
    {
        $course_reviews = Review::with(['user', 'reviewable'])
        ->where( 'reviewable_type', 'course')
        ->get();
        return view('reviews.course_reviews', compact('course_reviews'));
    }
}
