<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingsController extends Controller
{


    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $date = $request->validate([
            'booking_type' => 'required|string',
            'payment_status' => 'required|string',
            'amount_paid' => 'required|numeric',
        ]);

        $booking = Booking::create([
            'booking_type' => $date['booking_type'],
            'payment_status' => $date['payment_status'],
            'amount_paid' => $date['amount_paid'],
        ]);
        return redirect()->route('bookings.index')->with('success','');
    }
}
