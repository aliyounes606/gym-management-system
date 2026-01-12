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
    public function storeReview(Request $requset, $model) {

        $data = $requset->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string|max:1000',
        ]);
        $model->review()->create([
           'user_id'=>Auth::user()->id,
           'rating'=>$requset->rating,
           'comment'=>$requset->comment,
        ]);
    }


        // review a Course

    public function CourseReview(Request $request,Course $course)
    {
        $this->storeReview($request,$course);
        return response()->json('تم تقييم الكورس');
    }

    // review a trainer
    public function TrainerReview(Request $request,TrainerProfile $trainer)
    {
        $this->storeReview($request,$trainer);
        return response()->json(['massege'=>'تم تقييم المدرب'], 200);
    }

    // review a mealPlan
    public function MealPlanReview(Request $request,MealPlan $mealplan)
    {
        $this->storeReview($request,$mealplan);
        return response()->json(['massege'=>'تم تقييم الخطة'], 200);
    }

    public function GymSessionReview(Request $request,GymSession $gymsession)
    {
        if ($gymsession->course_id !== null)
        {
            return response()->json(['massege'=>'لا يمكن تقيم الجلسات المنتمية لكورس'],403);
        }
        else {
            $this->storeReview($request,$gymsession);
        return response()->json(['massege'=>'تم تقييم الجسلة'], 200);
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

        $traniner_reviews = Review::with('user')->where( 'reviewable_type', 'trainer')->get();
        return view('reviews.trainer_reviews', compact('traniner_reviews'));
    }
}
