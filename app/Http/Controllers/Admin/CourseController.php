<?php

namespace App\Http\Controllers;

use App\Models\Course;
//use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

//use App\Http\Requests\Admin\UpdateCourseRequest;

class CourseController extends Controller
{
    // عرض كل الكورسات
    public function index()
    {
        $courses = Course::all();
        return view('admin.course.index', compact('courses'));
    }

    // عرض فورم إنشاء كورس جديد
    public function create()
    {
        return view('admin.course.create');
    }

    // حفظ الكورس الجديد
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();
        $course = Course::create($validated);

        return redirect()->route('admin.course.show', $course->id)
                         ->with('success','تم إنشاء الكورس بنجاح');
    }

    // عرض كورس محدد
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.course.show', compact('course'));
    }

    // عرض فورم تعديل كورس
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.course.edit', compact('course'));
    }

    // تحديث الكورس
    public function update(UpdateCourseRequest $request, $id)
    {
        $validated = $request->validated();

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('admin.course.index')
                         ->with('success','تم تحديث الكورس بنجاح');
    }

    // حذف الكورس
    public function destroy($id)
    {
        Course::destroy($id);
        return redirect()->route('admin.course.index')
                         ->with('success','تم حذف الكورس');
    }
}
