<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $totalPrice;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;

        $this->totalPrice = Booking::where('batch_id', $booking->batch_id)->sum('price');
    }

    public function build()
    {
        return $this->from('admin@gym.com', config('app.name'))
            ->subject('✅ تم تأكيد حجزك وتفعيل الاشتراك')
            ->view('emails.booking_confirmed');
    }
}