<?php

namespace App\Http\Controllers;

use App\Models\GymSession;
use App\Models\User;
use App\Models\Course;
use App\Models\TrainerProfile;
 use App\Models\Category;
//use Illuminate\Http\Request;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;

class GymSessionController extends Controller
{
    // عرض كل الجلسات
    public function index()
    {
        $sessions = GymSession::with(['course','trainer.user','category'])->get();
        return view('sessions.index', compact('sessions'));
    }

    // صفحة إنشاء جلسة جديدة
   public function create() {
     $courses = Course::all(); 
     $categories = Category::all();
     $trainerProfiles = TrainerProfile::with('user')->get(); 
     return view('sessions.create', compact('courses', 'trainerProfiles','categories')); }

    // حفظ جلسة جديدة
    public function store(StoreSessionRequest $request)
    {
        $validated = $request->validated();

        GymSession::create($validated);

        return redirect()->route('gymsessions.index')
                         ->with('success','تم إنشاء الجلسة بنجاح');
    }

    // عرض جلسة واحدة
    public function show($id)
    {
        $session = GymSession::with(['course','trainer.user','category'])->findOrFail($id);
        return view('sessions.show', compact('session'));
    }

    // صفحة تعديل جلسة
    
public function edit($id)
{
    $session  = GymSession::findOrFail($id);
    $trainers = TrainerProfile::with('user')->get();
    $courses  = Course::all();
    $categories = Category::all();
    return view('sessions.edit', compact('session','trainers','courses','categories'));
}

    // تحديث جلسة
    public function update(UpdateSessionRequest $request, $id)
    {
        $session = GymSession::findOrFail($id);

        $validated = $request->validated(
  );

        $session->update($validated);

        return redirect()->route('gymsessions.index')
                         ->with('success','تم تعديل الجلسة بنجاح');
    }

    // حذف جلسة
    public function destroy($id)
    {
        $session = GymSession::findOrFail($id);
        $session->delete();

        return redirect()->route('gymsessions.index')
                         ->with('success','تم حذف الجلسة بنجاح');
    }
}
