<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\GymSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    /**
     * Marks the authenticated user as attended for a specific session if within the allowed 15-minute window.
     * Updates the booking status and returns a JSON response indicating success or specific validation errors.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAttendance(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:gymsessions,id',
        ]);

        $user = Auth::user();

        $booking = Booking::where('user_id', $user->id)
            ->where('session_id', $request->session_id)
            ->first();


        if (!$booking) {
            return response()->json(['status' => false, 'message' => 'عذراً، لا يوجد لديك حجز مؤكد.'], 404);
        }

        if ($booking->status === 'attended') {
            return response()->json(['status' => false, 'message' => 'تم تسجيل حضورك مسبقاً! ✅'], 400);
        }

        $session = $booking->gymsessions;

        if (!$session) {
            return response()->json(['status' => false, 'message' => 'خطأ في بيانات الجلسة'], 500);
        }

        $now = Carbon::now();
        $sessionStart = Carbon::parse($session->start_time);
        $allowedStart = $sessionStart->copy()->subMinutes(15);
        $allowedEnd = $sessionStart->copy()->addMinutes(15);

        if ($now->lessThan($allowedStart)) {
            $minutesToWait = $now->diffInMinutes($allowedStart);
            return response()->json(['status' => false, 'message' => "التسجيل يفتح قبل 15 دقيقة. انتظر $minutesToWait دقيقة."], 400);
        }

        if ($now->greaterThan($allowedEnd)) {
            return response()->json(['status' => false, 'message' => 'تجاوزت الوقت المسموح للتسجيل.'], 400);
        }

        try {
            DB::beginTransaction();

            $booking->update([
                'status' => 'attended',
                'attended_at' => Carbon::now(),
            ]);


            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'تم تسجيل الحضور بنجاح! 💪',
                'data' => [
                    'session' => $session->title,
                    'user' => $user->name,
                    'time' => Carbon::now()->format('h:i A')
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Attendance Error: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ غير متوقع أثناء التسجيل، يرجى المحاولة لاحقاً.',
            ], 500);
        }
    }
}