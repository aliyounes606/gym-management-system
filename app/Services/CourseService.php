<?php

namespace App\Services;

use App\Traits\ApiResponseTrait;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseService
{
    use ApiResponseTrait;

    /**
     * عرض كورس واحد باستخدام course_id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCourse(int $id)
    {
        try {
            $course = Course::with(['sessions', 'trainerProfile'])->findOrFail($id);

            return $this->successResponse($course, "تم جلب الكورس بنجاح", 200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse("الكورس غير موجود", 404);
        } catch (\Exception $e) {
            return $this->errorResponse("حدث خطأ غير متوقع", 500);
        }
    }

    /**
     * عرض كل الكورسات مع إمكانية الفلترة حسب category_id
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexCourse(Request $request)
    {
        try {
            $query = Course::with(['sessions', 'trainerProfile']);
            $courses = $query->paginate(10);

            if ($courses->isEmpty()) {
                return $this->errorResponse("لا توجد كورسات مطابقة لخيارات الفلترة", 404);
            }

            return $this->successResponse($courses, "تمت عملية جلب الكورسات بنجاح", 200);

        } catch (\Exception $e) {
            return $this->errorResponse("خطأ أثناء جلب الكورسات: " . $e->getMessage(), 500);
        }
    }
}
