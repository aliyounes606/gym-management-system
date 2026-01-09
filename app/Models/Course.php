<?php

namespace App\Models;

use App\Http\Controllers\BookingsController;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    //
    /**
     * Summary of fillable
     * @var array
     */

    protected $table = "courses";
    protected $fillable = [
        "name",
        "description",
        "trainer_profile_id",
        "total_price"
    ];

    /**
     * Summary of sessions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<GymSession, Course>
     */
    public function gymsessions()
    {
        return $this->hasMany(GymSession::class, 'course_id');
    }
    /**
     * Summary of trainerProfile
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TrainerProfile, Course>
     */
    public function trainerProfile()
    {
        return $this->belongsTo(TrainerProfile::class, 'trainer_profile_id');
    }
    public function booking()
    {
        return $this->belongsTo(BookingsController::class, 'booking_course');
    }
}
