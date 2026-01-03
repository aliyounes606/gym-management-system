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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->defulte(1);
            // $table->foreignId('session_id')->constrained('gymsessions')->onDelete('cascade')->nullable();
            $table->enum('booking_type', ['single', 'group']);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid')->nullable();
            $table->decimal('amount_paid');
            $table->boolean('attendance_status')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
