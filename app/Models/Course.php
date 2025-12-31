<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    //

  protected $table = "courses"; 
    protected $fillable =[
        "name",
        "description",
        "trainer_id",
        "total_price"
    ];
    
 
public function sessions()
{
    return $this->hasMany(GymSession::class, 'course_id');
}
public function trainerSessions()
{
    return $this->hasMany(GymSession::class, 'trainer_id');
}
}
