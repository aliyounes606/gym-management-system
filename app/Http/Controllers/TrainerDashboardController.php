<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GymSession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerDashboardController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $trainerProfile = $user->trainerProfile;

        if (!$trainerProfile) {
            return view('trainer.no-profile');
        }

        $todaySessionsCount = GymSession::where('trainer_profile_id', $trainerProfile->id)
            ->whereDate('start_time', Carbon::today())
            ->count();

        $monthSessionsTotal = GymSession::where('trainer_profile_id', $trainerProfile->id)
            ->whereMonth('start_time', Carbon::now()->month)
            ->count();

        $monthSessionsCompleted = GymSession::where('trainer_profile_id', $trainerProfile->id)
            ->whereMonth('start_time', Carbon::now()->month)
            ->where('status', 'completed')
            ->count();

        $completionRate = $monthSessionsTotal > 0
            ? round(($monthSessionsCompleted / $monthSessionsTotal) * 100)
            : 0;

        $activeStudentsCount = User::whereHas('gymSessions', function ($q) use ($trainerProfile) {
            $q->where('trainer_profile_id', $trainerProfile->id);
        })->distinct()->count();

        $upcomingCount = GymSession::where('trainer_profile_id', $trainerProfile->id)
            ->where('start_time', '>', Carbon::now())
            ->count();

        return view('admin.trainers.dashboard', compact(
            'todaySessionsCount',
            'monthSessionsTotal',
            'monthSessionsCompleted',
            'completionRate',
            'activeStudentsCount',
            'upcomingCount'
        ));
    }
}