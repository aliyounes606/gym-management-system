<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function gymSessions()
    {
        return $this->belongsToMany(GymSession::class,'session_equipment');
    }

    protected $fillable = ['name','status','quantity'];
    
   
}
