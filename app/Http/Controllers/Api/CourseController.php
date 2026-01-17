<?php

namespace App\Http\Controllers\Api;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CourseService;
class CourseController extends Controller
{
    use ApiResponseTrait;

    protected CourseService $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    // عرض كل الكورسات مع فلترة
    public function index(Request $request)
    {
        return $this->courseService->indexcourse($request);
    }

    // عرض كورس واحد حسب ID
    public function show($id)
    {
        return $this->courseService->showcourse($id);
    }
}
