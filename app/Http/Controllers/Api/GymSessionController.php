<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GymSession;
use Illuminate\Http\Request;

class GymSessionController extends Controller
{/**
 * show the session to the user with json response 
 * he can filter it by course_id cateroy_id profile_trainer_id
 *
 * @param Request $request
    * @return \Illuminate\Http\JsonResponse

 */
    // عرض كل الجلسات مع فلترة
    public function index(Request $request)
    {
        try {
            $query = GymSession::with([
                'course',
                'trainer',
                'category',
            ]);

            // فلترة حسب الفئة
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // فلترة حسب الكورس
            if ($request->has('course_id')) {
                $query->where('course_id', $request->course_id);
            }


           // فلترة حسب المدرب 
            if ($request->has('trainer_profile_id')) 
            { $query->where('trainer_profile_id', $request->trainer_profile_id); }
            
            
            $sessions = $query->get();

            return response()->json([
                'status' => true,
                'data' => $sessions
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ أثناء جلب البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }
/**
 * show session by using session_id
 *
 * @param [type] $id
 * @return \Illuminate\Http\JsonResponse

 */
    // عرض جلسة واحدة
    public function show($id)
    {
        try {
            $session = GymSession::with([
                'course',
                'trainer',
                'category',
            ])->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => $session
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'الجلسة غير موجودة أو حدث خطأ',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
