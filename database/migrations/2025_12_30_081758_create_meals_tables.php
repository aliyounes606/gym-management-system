<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    // 1. جدول مكتبة الوجبات 
    Schema::create('meal_plans', function (Blueprint $table) {
        $table->id();
        $table->string('name'); 
        $table->text('description')->nullable();
        $table->integer('calories')->default(0);
        $table->decimal('price', 8, 2)->default(0);
        $table->foreignId('trainer_id')->nullable()->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });

    // 2. جدول التوصيات (الربط بين الوجبة والمتدرب)
    Schema::create('meal_recommendations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المتدرب
        $table->foreignId('meal_plan_id')->constrained('meal_plans')->onDelete('cascade'); // الوجبة المختارة
        $table->foreignId('trainer_id')->nullable()->constrained('users')->onDelete('cascade'); // المدرب اللي وصى بها
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_recommendations');
        Schema::dropIfExists('meal_tables');
    }
};
