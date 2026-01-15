<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Events\BookingPaid;

class PaymentController extends Controller
{
    public function index()
    {
        $pendingBookings = Booking::with(['users', 'gymsessions'])
            ->where('payment_status', 'unpaid')
            ->where('status', 'pending')
            ->latest()
            ->get()
            ->groupBy('batch_id');

        return view('admin.payments.index', compact('pendingBookings'));
    }

    public function confirm(Request $request, $batchId)
    {
        Booking::where('batch_id', $batchId)->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);

        $booking = Booking::with('users')->where('batch_id', $batchId)->first();

        // 3. إطلاق حدث الإيميل
        if ($booking) {
            event(new BookingPaid($booking));
        }

        return redirect()->back()->with('success', 'تم التفعيل وإرسال إيميل التأكيد للمستخدم ');
    }

    public function destroy($batchId)
    {
        Booking::where('batch_id', $batchId)->delete();
        return redirect()->back()->with('error', 'تم إلغاء الحجز وحذفه.');
    }
}