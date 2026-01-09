<?php

namespace App\Models;

use App\Http\Controllers\BookingsController;
use Illuminate\Database\Eloquent\Model;
use App\Models\GymSession;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'batch_id',
        'payment_status',
        'status',
        'price',
        'attended_at',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function gymsessions()
    {
        return $this->belongsTo(GymSession::class, 'session_id');
    }
    public function courses()
    {
        return $this->belongsTo(BookingsController::class, 'booking_course');
    }
}
