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
    
 Schema::create('meal_plans', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('name'); // الاسم
        $table->text('description'); // الوصف
        $table->integer('calories'); // السعرات الحرارية 
        $table->decimal('price', 8, 2); // السعر
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // المتدرب المستلم
        $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade'); // المدرب المرسل
        $table->timestamps();
    });

    
    Schema::create('meal_recommendations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('meal_plan_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_recommendations');
        Schema::dropIfExists('meals_tables');
    }
};
