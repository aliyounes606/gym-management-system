<?php

namespace App\Listeners;

use App\Events\BookingPaid;
use App\Mail\BookingConfirmedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentConfirmationEmail implements ShouldQueue
{
    // مهلة زمنية قصيرة لضمان اكتمال عملية التحديث في الداتابيز قبل الإرسال
    public $delay = 2;

    public function handle(BookingPaid $event)
    {
        if ($event->booking->users && $event->booking->users->email) {

            Mail::to($event->booking->users->email)
                ->send(new BookingConfirmedMail($event->booking));

        }
    }
}