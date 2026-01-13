<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DailyAttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $query = Booking::with(['users', 'gymsessions'])
            ->whereHas('gymsessions', function ($q) use ($today) {
                $q->whereDate('start_time', $today);
            })
            ->orderBy(function ($query) {
                $query->select('start_time')
                    ->from('gymsessions')
                    ->whereColumn('gymsessions.id', 'bookings.session_id');
            });

        if ($user->hasRole('trainer') && !$user->hasRole('admin')) {

            $trainerId = $user->trainerProfile->id;

            $query->whereHas('gymsessions', function ($q) use ($trainerId) {
                $q->where('trainer_profile_id', $trainerId);
            });
        }


        $bookings = $query->get();

        return view('admin.daily_attendance', compact('bookings'));
    }
}