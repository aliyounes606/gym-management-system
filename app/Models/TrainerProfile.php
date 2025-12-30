<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerProfile extends Model
{
    protected $fillable = ['user_id', 'specialization', 'bio', 'experience_years'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
