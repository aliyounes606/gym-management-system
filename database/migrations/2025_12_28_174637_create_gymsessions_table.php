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
        Schema::create('gymsessions', function (Blueprint $table) {
    $table->id();
    $table->string("title");
    $table->foreignId("trainer_id")->constrained("users")->onDelete("restrict");
    $table->foreignId("course_id")->constrained("courses")->onDelete("restrict");
    $table->decimal("single_price", 8, 2);
    $table->integer("max_capacity");
    $table->dateTime("start_time");
    $table->dateTime("end_time");
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gymsessions');
    }
};
