<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Controllers\GymSessionController;
use App\Models\GymSession;
use App\Models\Course;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        function session_booking()
        {
            $gymSessions = GymSession::where('course_id',Null)->get();
            return view('bookings.sessions_bookings', compact('gymSessions'));
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


    public function bookCorse()
    {
       Booking::create([
            'booking_type'=>'group',
            'amount_paid'=> 10,
            'attendance_status'=> 1,
        ]);
    }
    public function bookSession(GymSession $request)
    {
            $booking = Booking::create([
            'booking_type'=>'single',
            'amount_paid'=> 3,
            'attendance_status'=> 1,
        ]);
    }
}