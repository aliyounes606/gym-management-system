<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * represents gym equipment entity.
 * 
 * defines relationships with images and categories and images, and exposes computed attributes such as image_url 
 * for both web and API responsees.
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

