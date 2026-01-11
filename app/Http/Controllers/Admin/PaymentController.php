<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'تم تأكيد الدفع وتفعيل الاشتراك بنجاح ✅');
    }


    public function destroy($batchId)
    {
        Booking::where('batch_id', $batchId)->delete();
        return redirect()->back()->with('error', 'تم إلغاء الحجز وحذفه.');
    }
}
