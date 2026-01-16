<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{/**
 * show the session to the user with json response 
 * he can filter it by cateroy_id 
 *
 * @param Request $request
    * @return \Illuminate\Http\JsonResponse

 */
    // عرض كل الكورسات مع فلترة
    public function index(Request $request)
    {
        try {
            $query = Course::with([
                'sessions',
                'trainerProfile'
            ]);

            // فلترة حسب الفئة
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $courses = $query->get();

            return response()->json([
                'status' => true,
                'data' => $courses
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ أثناء جلب الكورسات',
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
    // عرض كورس واحد حسب ID
    public function show($id)
    {
        try {
            $course = Course::with([
                'sessions',
                'trainerProfile'
            ])->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => $course
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'الكورس غير موجود أو حدث خطأ',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
