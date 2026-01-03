<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerProfile extends Model
{
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = ['user_id', 'specialization', 'bio', 'experience_years'];
    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, TrainerProfile>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
