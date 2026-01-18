<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class AttendanceController extends Controller
{
    use ApiResponseTrait;

    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    /**
     * Marks the authenticated user as attended
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAttendance(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:gymsessions,id',
        ]);

        try {
            $booking = $this->attendanceService->markUserAttendance(auth()->user(), $request->session_id);

            $responseData = [
                'session' => $booking->gymsessions->title ?? 'Unknown Session',
                'user' => auth()->user()->name,
                'time' => Carbon::parse($booking->attended_at)->format('h:i A')
            ];

            return $this->successResponse(
                $responseData,
                'تم تسجيل الحضور بنجاح!'
            );

        } catch (Exception $e) {
            $code = $e->getCode() && $e->getCode() !== 0 ? $e->getCode() : 500;

            return $this->errorResponse(
                $e->getMessage(),
                $code
            );
        }
    }
}