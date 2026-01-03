<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    
    
      /**
     * علاقة القسم مع الجلسات التدريبية
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(GymSession::class);
    }

    /**
     * علاقة القسم مع المعدات
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
