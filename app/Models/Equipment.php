<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * represents gym equipment entity.
 * 
 * handles relationships with images and categories and provides computed such as image_url.
 */

class Equipment extends Model
{
  protected $appends = ['image_url'];
  protected $table = "equipment";
  protected $fillable = [
    "name",
    "status",
    "quantity"
  ];


  public function image()
  {
    return $this->morphOne(\App\Models\Image::class, 'imageable');
  }

  public function category()
  {
    return $this->belongsToMany(Category::class,'category_equipment');
  }

    // accessor لرابط الصورة
    public function getImageUrlAttribute()
{
    return $this->image
        ? asset('storage/' . $this->image->path): null;
}
} 

