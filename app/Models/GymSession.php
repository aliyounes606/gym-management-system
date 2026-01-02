<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use App\Models\User; 
Use  App\Models\Course;
use App\Models\Equipment;
class GymSession extends Model
//تحديد الجدول
{   
     protected $table = "gymsessions";
   //استقبال المتغيرات
    protected $fillable = [
        "title",
        "trainer_id",
        "course_id",
        "single_price",
        "max_capacity",
        "start_time",
        "end_time",
    ];
//علاقة الكورس مع الجلسات 
public function Course(){
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
  return $this->belongsTo(user::class,'trainer_id');   
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

}
