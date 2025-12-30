<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymSession extends Model
{
    public function equipment()
    {
        return 
          $this->belongsToMany(Equipment::class, 'session_equipment');
    }
}
