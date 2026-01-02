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
        return view('courses.index', compact('courses'));
    }

    // عرض فورم إنشاء كورس جديد
    public function create()
{//للتجريب تضمين اسم المدرب
    $trainerProfiles = \App\Models\TrainerProfile::with('user')->get();
    return view('courses.create', compact('trainerProfiles'));
}


    // حفظ الكورس الجديد
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();
        $course = Course::create($validated);

        return redirect()->route('courses.show', $course->id)
                         ->with('success','تم إنشاء الكورس بنجاح');
    }

    // عرض كورس محدد
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    // عرض فورم تعديل كورس
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    // تحديث الكورس
    public function update(UpdateCourseRequest $request, $id)
    {
        $validated = $request->validated();

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index')
                         ->with('success','تم تحديث الكورس بنجاح');
    }

    // حذف الكورس
    public function destroy($id)
    {
        Course::destroy($id);
        return redirect()->route('courses.index')
                         ->with('success','تم حذف الكورس');
    }
}
