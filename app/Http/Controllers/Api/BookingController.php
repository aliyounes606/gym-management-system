<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSingleBookingRequest;
use App\Http\Requests\Api\StoreCourseBookingRequest;
use App\Services\BookingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;
use Exception;

class BookingController extends Controller
{
    use ApiResponseTrait;

    protected $bookingService;

    /**
     * Summary of __construct
     * @param \App\Services\BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Summary of storeSingleSession
     * @param \App\Http\Requests\Api\StoreSingleBookingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSingleSession(StoreSingleBookingRequest $request)
    {
        try {
            $user = auth()->user();

            $booking = $this->bookingService->bookSingleSession($user, $request->session_id);

            $responseData = [
                'booking_reference' => $booking->batch_id,
                'data' => $booking
            ];

            return $this->successResponse(
                $responseData,
                'تم استلام طلب الحجز. يرجى التوجه للاستقبال للدفع لتفعيل الحجز.',
                201
            );

        } catch (Exception $e) {
            $code = $e->getCode() >= 400 && $e->getCode() < 600 ? $e->getCode() : 500;

            if ($code == 500) {
                Log::error("Error in storeSingleSession: " . $e->getMessage());
            }

            return $this->errorResponse(
                $e->getMessage(),
                $code,
                config('app.debug') && $code == 500 ? ['exception' => $e->getMessage()] : []
            );
        }
    }

    /**
     * Summary of storeCourse
     * @param \App\Http\Requests\Api\StoreCourseBookingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCourse(StoreCourseBookingRequest $request)
    {
        try {
            $user = auth()->user();

            $result = $this->bookingService->bookCourse($user, $request->course_id);

            return $this->successResponse(
                $result,
                'تم حجز الكورس مبدئياً. يرجى دفع المبلغ الإجمالي في الاستقبال.',
                201
            );

        } catch (Exception $e) {
            $code = $e->getCode() >= 400 && $e->getCode() < 600 ? $e->getCode() : 500;

            if ($code == 500) {
                Log::error("Error in storeCourse: " . $e->getMessage());
                return $this->errorResponse(
                    'فشلت عملية حجز الكورس، لم يتم خصم أي شيء.',
                    500,
                    config('app.debug') ? ['exception' => $e->getMessage()] : []
                );
            }

            return $this->errorResponse($e->getMessage(), $code);
        }
    }
}