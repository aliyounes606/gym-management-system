<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{


  protected $table = "equipment";
  protected $fillable = [
    "name",
    "status",
    "quantity"
  ];


  public function categories()
  {
    return $this->belongsToMany(Category::class, 'category_equipment', 'equipment_id', 'category_id');
  }

}

