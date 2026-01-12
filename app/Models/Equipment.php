<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    return $this->morphOne(Image::class, 'imageable');
  }

  public function category()
  {
    return $this->belongsToMany(Category::class,'category_equipment');
  }

    // accessor لرابط الصورة
    public function getImageUrlAttribute()
{
    // إذا العلاقة غير موجودة أو فاضية
    if (!$this->relationLoaded('images') || $this->images->isEmpty()) {
        return null;
    }

    $image = $this->images->first();

    return $image
        ? asset('storage/' . $image->path)
        : null;
}

}

