<?php

namespace App\Models;

use App\Http\Controllers\BookingsController;
use Illuminate\Database\Eloquent\Model;
use app\Models\GymSession;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'course_id',
        'booking_type',
        'payment_status',
        'amount_paid',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'bookings_users');
    }
    public function gymSessions()
    {
        return $this->belongsTo(GymSession::class, 'bookings_gymsessions');
    }
    public function courses()
    {
        return $this->belongsTo(BookingsController::class, 'booking_course');
    }
}
