<?php

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;
use Exception;

class AttendanceService
{
    /**
     * Marks the authenticated user as attended for a specific session if within the allowed 15-minute window.
     * Updates the booking status and returns a JSON response indicating success or specific validation errors.
     * @param mixed $user
     * @param mixed $sessionId
     * @throws \Exception
     * @return Booking
     */
    public function markUserAttendance($user, $sessionId)
    {
        $booking = Booking::with('gymsessions')
            ->where('user_id', $user->id)
            ->where('session_id', $sessionId)
            ->first();

        if (!$booking) {
            throw new Exception('عذراً، لا يوجد لديك حجز مؤكد لهذه الجلسة.', 404);
        }

        if ($booking->status === 'attended') {
            throw new Exception('تم تسجيل حضورك مسبقاً!', 400);
        }

        $session = $booking->gymsessions;
        if (!$session) {
            throw new Exception('بيانات الجلسة غير متوفرة.', 500);
        }

        $now = Carbon::now();
        $sessionStart = Carbon::parse($session->start_time);

        $allowedStart = $sessionStart->copy()->subMinutes(15);
        $allowedEnd = $sessionStart->copy()->addMinutes(15);

        if ($now->lessThan($allowedStart)) {
            $minutesToWait = $now->diffInMinutes($allowedStart);
            throw new Exception("التسجيل يفتح قبل 15 دقيقة. يرجى الانتظار $minutesToWait دقيقة.", 400);
        }

        if ($now->greaterThan($allowedEnd)) {
            throw new Exception('عذراً، تجاوزت الوقت المسموح للتسجيل.', 400);
        }

        $booking->update([
            'status' => 'attended',
            'attended_at' => $now,
        ]);

        return $booking;
    }
}