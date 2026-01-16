<?php

namespace App\Http\Controllers;

use App\Models\Course;
//use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\TrainerProfile;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

//use App\Http\Requests\Admin\UpdateCourseRequest;

class CourseController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [ new Middleware('can:sessions.view', only: ['index', 'show']),
            new Middleware('can:sessions.create', only: ['create', 'store']),
            new Middleware('can:sessions.update', only: ['edit', 'update']),
            new Middleware('can:sessions.delete', only: ['destroy']),
        ];
    }

    /**
 * Display a listing of all courses.
 *
 * show the list of the courses in the system 
 *
 * @return \Illuminate\View\View    (courses.index)
 */
    // عرض كل الكورسات
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }
    /** * Show the form for creating a new course. 
     * show the form to create a new course withthe avilable trainer
     * @return \Illuminate\View\View (courses.create)
     * */
    // عرض فورم إنشاء كورس جديد
    public function create()
    {
        $trainerProfiles = TrainerProfile::with('user')->get();
        return view('courses.create', compact('trainerProfiles'));
    }

/**
 * store the course after validated it 
 *
 * @param StoreCourseRequest $request
 *
 */
    // حفظ الكورس الجديد
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();
        $course = Course::create($validated);

        return redirect()->route('courses.show', $course->id)
            ->with('success', 'تم إنشاء الكورس بنجاح');
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
        $trainerProfiles = TrainerProfile::with('user')->get();
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course', 'trainerProfiles'));
    }
    /** * Update the specified course in storage. * 
     * *after validated it 
     * * * @param \App\Http\Requests\UpdateCourseRequest $request     
     * * @param int $id    
     * * @return \Illuminate\Http\RedirectResponse 
     *  * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     * */
    // تحديث الكورس
    public function update(UpdateCourseRequest $request, $id)
    {
        $validated = $request->validated();

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index')
            ->with('success', 'تم تحديث الكورس بنجاح');
    }
    /** * Remove the specified course from storage. *
     *  * delete course  *
     *  * @param int $id course_id
     * * @return \Illuminate\Http\RedirectResponse 
     * */
    // حذف الكورس
    public function destroy($id)
    {
        Course::destroy($id);
        return redirect()->route('courses.index')
            ->with('success', 'تم حذف الكورس');
    }
}
