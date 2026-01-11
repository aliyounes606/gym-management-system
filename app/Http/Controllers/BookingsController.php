<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Controllers\GymSessionController;
use App\Http\Requests\StoreBookingRequest;
use App\Models\GymSession;
use App\Models\Course;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    private $counter = 0;

    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        function session_booking()
        {
            $InSessionCounter = Booking::where('session_id','3')->count();
            $gymSessions = GymSession::where('course_id',Null)->get();
            return view('bookings.sessions_bookings', compact('gymSessions','InSessionCounter'));
        }
        function course_booking()
        {
            $courses = Course::All();
            return view('bookings.courses_bookings', compact('courses'));
        }

        if($request->action === 'sessions')
        return session_booking();

        else if($request->action === 'courses')
        return course_booking();
    }


    public function bookCorse(Request $request)
    {
    
    $request->validate([
    'course_id'  => 'required|nullable|exists:courses,id',
    ]);

    
       Booking::create([
           'user_id'=>Auth::user()->id,
           'session_id'=>$request->session_id,
           'course_id'=>$request->course_id,
           'booking_type'=>'course',
           'payment_status'=>'unpaid',
           'amount_paid'=> $request->total_price,
           'attendance_status'=> 1,
        ]);
        return redirect()->back()->with('success', 'تم حجز الجلسة بنجاح!');
    }

    
    public function bookSession(request $request)
    {

       Booking::create([
           'user_id'=>Auth::user()->id,
           'session_id'=>$request->session_id,
           'course_id'=>null,
           'booking_type'=>'session',
           'payment_status'=>'unpaid',
           'amount_paid'=> $request->single_price,
           'attendance_status'=> 1,
        ]);
        return redirect()->back()->with('success', 'تم حجز الجلسة بنجاح!');
    }
}