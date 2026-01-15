<?php

namespace App\Models;

use App\Http\Controllers\BookingsController;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    //
    /**
     * Summary of fillable has profile id for the trainer
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
 * Summary of sessions the relations with sessions one to many the course can have many session
 * @return \Illuminate\Database\Eloquent\Relations\HasMany<GymSession, Course>
 */
public function sessions()
{
    return $this->hasMany(GymSession::class, 'course_id');
}
/**
 * Summary of trainerProfile the relation with trainer one to one the trainer have one course 
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
    // morph relation for review the course
public function review()
{
    return $this->morphMany(Review::class,'reviewable');
}

}
