<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Course;
use App\Models\GymSession;
use App\Http\Requests\Api\StoreSingleBookingRequest;
use App\Http\Requests\Api\StoreCourseBookingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class BookingController extends Controller
{
    /**
     * Handle the process of booking a single gym session.
     * This method validates session capacity and checks for duplicate bookings 
     * before creating a new pending booking record for the authenticated user.
     * @param \App\Http\Requests\Api\StoreSingleBookingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSingleSession(StoreSingleBookingRequest $request)
    {
        try {
            $user = auth()->user();

            $session = GymSession::findOrFail($request->session_id);

            $currentBookings = Booking::where('session_id', $session->id)
                ->whereIn('status', ['confirmed', 'pending'])
                ->count();

            if ($currentBookings >= $session->max_capacity) {
                return response()->json(['message' => 'عذراً، الجلسة ممتلئة تماماً.'], 400);
            }

            $existingBooking = Booking::where('user_id', $user->id)
                ->where('session_id', $session->id)
                ->whereIn('status', ['confirmed', 'pending'])
                ->exists();

            if ($existingBooking) {
                return response()->json(['message' => 'أنت قمت بحجز هذه الجلسة مسبقاً.'], 400);
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'session_id' => $session->id,
                'batch_id' => Str::uuid(),
                'price' => $session->single_price,
                'payment_status' => 'unpaid',
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'تم استلام طلب الحجز. يرجى التوجه للاستقبال للدفع لتفعيل الحجز.',
                'booking_reference' => $booking->batch_id,
                'data' => $booking
            ], 201);

        } catch (Exception $e) {
            Log::error("Error in storeSingleSession: " . $e->getMessage());

            return response()->json([
                'message' => 'حدث خطأ غير متوقع أثناء الحجز، يرجى المحاولة لاحقاً.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Handle the bulk booking process for a complete course and its associated sessions.
     * This method executes a database transaction to create pending booking records for all 
     * unbooked sessions within the course, grouping them under a unique batch ID.
     * @param \App\Http\Requests\Api\StoreCourseBookingRequest $request
     */
    public function storeCourse(StoreCourseBookingRequest $request)
    {
        try {
            $user = auth()->user();
            $course = Course::with('sessions')->findOrFail($request->course_id);

            if ($course->sessions->isEmpty()) {
                return response()->json(['message' => 'هذا الكورس لا يحتوي على جلسات حالياً.'], 400);
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
                    return response()->json(['message' => 'يبدو أنك مسجل بالفعل في  هذا الكورس.'], 400);
                }

                return response()->json([
                    'message' => 'تم حجز الكورس مبدئياً. يرجى دفع المبلغ الإجمالي في الاستقبال.',
                    'booking_reference' => $batchId,
                    'sessions_booked_count' => count($createdBookings),
                    'total_price' => $totalPriceToPay
                ], 201);
            });

        } catch (Exception $e) {
            Log::error("Error in storeCourse: " . $e->getMessage());

            return response()->json([
                'message' => 'فشلت عملية حجز الكورس، لم يتم خصم أي شيء.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}