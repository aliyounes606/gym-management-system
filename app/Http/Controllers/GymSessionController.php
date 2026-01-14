<?php

namespace App\Http\Controllers;

use App\Models\GymSession;
use App\Models\User;
use App\Models\Course;
use App\Models\TrainerProfile;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GymSessionController extends Controller implements HasMiddleware
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
     * Display a listing of the gym sessions.
     *
     * @return \Illuminate\View\View
     *      */
    // عرض كل الجلسات
    public function index()
    {
        $sessions = GymSession::with(['course', 'trainer.user', 'category'])->get();
        return view('sessions.index', compact('sessions'));
    }
    /**
     * Store a newly created gym session in storage.
     *
     * @return \Illuminate\View\View
     */
    // صفحة إنشاء جلسة جديدة
    public function create()
    {
        $courses = Course::all();
        $categories = Category::all();
        $trainerProfiles = TrainerProfile::with('user')->get();
        return view('sessions.create', compact('courses', 'trainerProfiles', 'categories'));
    }
    /**
     * Undocumented function
     *
     * @param StoreSessionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // حفظ جلسة جديدة
    public function store(StoreSessionRequest $request)
    {
        $validated = $request->validated();

        GymSession::create($validated);

        return redirect()->route('gymsessions.index')
            ->with('success', 'تم إنشاء الجلسة بنجاح');
    }
    /** * Display the specified gym session. 
     * يعرض تفاصيل جلسة معينة.
     * @param int $id 
     * @return \Illuminate\View\View 
     * */
    // عرض جلسة واحدة
    public function show($id)
    {
        $session = GymSession::with(['course', 'trainer.user', 'category'])->findOrFail($id);
        return view('sessions.show', compact('session'));
    }

    // صفحة تعديل جلسة

    public function edit($id)
    {
        $session = GymSession::findOrFail($id);
        $trainers = TrainerProfile::with('user')->get();
        $courses = Course::all();
        $categories = Category::all();
        return view('sessions.edit', compact('session', 'trainers', 'courses', 'categories'));
    }
    /** * Update the specified gym session in storage. *
     * يعدّل بيانات جلسة معينة. *
     * @param \Illuminate\Http\Request 
     * @param int $id * @return \Illuminate\Http\RedirectResponse
     */
    // تحديث جلسة
    public function update(UpdateSessionRequest $request, $id)
    {
        $session = GymSession::findOrFail($id);

        $validated = $request->validated(
        );

        $session->update($validated);
        return redirect()->route('gymsessions.index')
            ->with('success', 'تم تعديل الجلسة بنجاح');
    }
    /** * Remove the specified gym session from storage. * 
     * يحذف جلسة معينة من قاعدة البيانات. 
     * @param int $id 
     * @return \Illuminate\Http\RedirectResponse 
     */
    // حذف جلسة
    public function destroy($id)
    {
        $session = GymSession::findOrFail($id);
        $session->delete();

        return redirect()->route('gymsessions.index')
            ->with('success', 'تم حذف الجلسة بنجاح');
    }

    /**
 * Display the schedule of a specific trainer.

 * @param  int  $id  رقم تعريف المدرب (TrainerProfile ID)
 * @return \Illuminate\View\View  صفحة العرض التي تحتوي على بيانات المدرب والجلسات
 *
 */
    public function schedule($id)
    //find if trainner id exist 
    {
        $trainer = TrainerProfile::with('user')
            ->findOrFail($id);
        //get sessions that assigned to the trainer
        $sessions = GymSession::where('trainer_profile_id', $id)
            ->with(['course', 'category'])
            //sort the session asc
            ->orderBy('start_time', 'asc')->get();
        //return it to the page blade 
        return view('sessions.schedule', compact('trainer', 'sessions'));
    }


    /**
     * Update the status of the specified gym session.
     *
     * يحدّث حالة الجلسة (قيد الانتظار، بدأت، انتهت، ملغاة).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $session = GymSession::findOrFail($id);
        $session->status = $request->status;
        $session->save();

        return back()->with('success', 'تم تحديث حالة الجلسة بنجاح');
    }

}
