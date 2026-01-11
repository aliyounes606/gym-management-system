<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TrainerProfile ; 
use App\Models\Course;
use App\Models\Equipment;
class GymSession extends Model
{    
     protected $table = "gymsessions";
   //استقبال المتغيرات
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
public function course(){
    return $this->belongsTo(Course::class,'course_id');
}
//علاقة المعدات k
 /**
  * Summary of equipment
  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Equipment, GymSession, \Illuminate\Database\Eloquent\Relations\Pivot>
  */
 public function equipment()
    {
        return
            $this->belongsToMany(Equipment::class, 'session_equipment');
    }
    //علاقة المدرب مع الجلسات 
/**
 * Summary of trainer 
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TrainerProfile, GymSession>
 */
public function trainer(){
  return $this->belongsTo(TrainerProfile::class,'trainer_profile_id');   
}
  public function users()
{
    return $this->belongsToMany(
        User::class,
        'bookings',
        'gym_session_id',
        'user_id'
    )->withPivot('booking_type')
     ->withTimestamps();
  }

public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'bookings_gymsessions');
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
    
}
