<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\GymSession;

class Booking extends Model
{
    protected $fillable = [
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
}
