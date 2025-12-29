<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function sessions()
    {
        return 
         $this->belongsToMany(Session::class, 'session_equipment');
    }
}
