<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TrainerProfile;
use App\Models\Course;
use App\Models\Equipment;
class GymSession extends Model
{
    protected $table = "gymsessions";
    /**
     * Summary of fillable has a relation with trainerprofile , course and category
     * @var array
     */
    protected $fillable = [
        "title",
        "trainer_profile_id",
        "course_id",
        "single_price",
        "max_capacity",
        "start_time",
        "end_time",
        'category_id',
        'status',
    ];

    //علاقة الكورس مع الجلسات 
    /**
     * Summary of course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Course, GymSession>
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    //علاقة المعدات k
   
    public function equipment()
    {
        return
            $this->belongsToMany(Equipment::class, 'session_equipment');
    }
    //علاقة المدرب مع الجلسات 
  
    public function trainer()
    {
        return $this->belongsTo(TrainerProfile::class, 'trainer_profile_id');
    }
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'bookings',
            'session_id',
            'user_id'
        )->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'session_id');
    }
    //علاقة الجلسة بالفئة من اجل المعدات 
    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category, GymSession>
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // morph relation for review the session
    public function review()
    {
        return $this->morphMany(Review::class,'reviewable');
    }

}
