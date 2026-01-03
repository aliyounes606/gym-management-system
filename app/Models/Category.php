<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];


    /**
     * Summary of sessions
     * @return HasMany<GymSession, Category>
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(GymSession::class);
    }

    /**
     * Summary of equipment
     * @return BelongsToMany<Equipment, Category, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(
            Equipment::class,
            'category_equipment',
            'category_id',
            'equipment_id'
        );
    }
}
