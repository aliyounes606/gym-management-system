<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function equipment()
{
    return $this->belongsToMany(Equipment::class, 'category_equipment','category_id','equipment_id');
}
}
