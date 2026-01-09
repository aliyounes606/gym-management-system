<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MealPlan extends Model
{
    // أضفنا user_id و trainer_id لربط الوجبة بالمتدرب والمدرب
    protected $fillable = ['name', 'description', 'calories', 'price', 'user_id', 'trainer_id'];

    /**
     * علاقة المورف (Polymorphic) مع جدول الصور.
     * القائد طلب أن تكون الصور "مورف" ليكون جدول الصور موحداً لكل الموقع.
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * علاقة المتدرب: الوجبة تنتمي لمستخدم (متدرب) محدد.
     */
    public function trainee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * علاقة المدرب: الوجبة تمت إضافتها بواسطة مدرب.
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    /**
     * علاقة قديمة إذا كنت لا تزال تستخدم الجدول الوسيط، 
     * لكن نظام التوصية المباشر (user_id) أسهل وأدق.
     */
    public function members() 
    {
        return $this->belongsToMany(User::class, 'meal_recommendations');
    }
}