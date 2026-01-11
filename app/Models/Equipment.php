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


  public function image()
  {
    return $this->morphOne(Image::class, 'imageable');
  }

  public function category()
  {
    return $this->belongsToMany(Category::class);
  }


}

