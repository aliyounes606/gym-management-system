<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Course;
use App\Models\GymSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class BookingService
{
    /**
     *  Handle the process of booking a single gym session.
     * This method validates session capacity and checks for duplicate bookings 
     * before creating a new pending booking record for the authenticated user.
     * @param mixed $user
     * @param mixed $sessionId
     * @throws \Exception
     * @return Booking
     */
    public function bookSingleSession($user, $sessionId)
    {
        $session = GymSession::findOrFail($sessionId);

        $currentBookings = Booking::where('session_id', $session->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->count();

        if ($currentBookings >= $session->max_capacity) {
            throw new Exception('عذراً، الجلسة ممتلئة تماماً.', 400);
        }

        $existingBooking = Booking::where('user_id', $user->id)
            ->where('session_id', $session->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        if ($existingBooking) {
            throw new Exception('أنت قمت بحجز هذه الجلسة مسبقاً.', 400);
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'session_id' => $session->id,
            'batch_id' => Str::uuid(),
            'price' => $session->single_price,
            'payment_status' => 'unpaid',
            'status' => 'pending',
        ]);

        return $booking;
    }

    /**
     *  Handle the bulk booking process for a complete course and its associated sessions.
     * This method executes a database transaction to create pending booking records for all 
     * unbooked sessions within the course, grouping them under a unique batch ID.
     * @param mixed $user
     * @param mixed $courseId
     * @throws \Exception
     */
    public function bookCourse($user, $courseId)
    {
        $course = Course::with('sessions')->findOrFail($courseId);

        if ($course->sessions->isEmpty()) {
            throw new Exception('هذا الكورس لا يحتوي على جلسات حالياً.', 400);
        }

        return DB::transaction(function () use ($user, $course) {
            $batchId = Str::uuid();
            $createdBookings = [];
            $totalPriceToPay = 0;

            foreach ($course->sessions as $session) {
                $exists = Booking::where('user_id', $user->id)
                    ->where('session_id', $session->id)
                    ->exists();

                if (!$exists) {
                    $booking = Booking::create([
                        'user_id' => $user->id,
                        'session_id' => $session->id,
                        'batch_id' => $batchId,
                        'price' => $session->single_price,
                        'payment_status' => 'unpaid',
                        'status' => 'pending',
                    ]);

                    $createdBookings[] = $booking;
                    $totalPriceToPay += $session->single_price;
                }
            }

            if (empty($createdBookings)) {
                throw new Exception('يبدو أنك مسجل بالفعل في جميع جلسات هذا الكورس.', 400);
            }

            return [
                'booking_reference' => $batchId,
                'sessions_booked_count' => count($createdBookings),
                'total_price' => $totalPriceToPay
            ];
        });
    }
}