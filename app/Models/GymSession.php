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
    ];
//علاقة الكورس مع الجلسات 
public function course(){
    return $this->belongsTo(Course::class,'course_id');
}
//علاقة المعدات k
 public function equipment()
    {
        return
            $this->belongsToMany(Equipment::class, 'session_equipment');
    }
    //علاقة المدرب مع الجلسات 
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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
