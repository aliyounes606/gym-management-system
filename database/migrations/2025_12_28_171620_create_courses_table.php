<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    //    Schema::create('courses', function (Blueprint $table) {
    //         $table->id();
    //         $table->string("name");//اسم الكورس
    //         $table->text("description");// وصفه
    //         //for trainer_id  
    //         $table->foreignId("trainer_id")->constrained("users")->onDelete("restrict");//المدرب المسؤول
    //         $table->decimal("total_price",8,2);//السعر النهائي
    //         $table->timestamps();
    //     });
    Schema::create('courses', function (Blueprint $table) {
    $table->id();
    $table->string("name"); // اسم الكورس
    $table->text("description"); // وصفه
    $table->foreignId("trainer_id")->constrained("users")->onDelete("restrict"); // المدرب المسؤول
    $table->decimal("total_price", 8, 2); // السعر النهائي
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
