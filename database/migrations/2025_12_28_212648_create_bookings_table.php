<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('session_id')->constrained('gymsessions')->onDelete('cascade');

            $table->uuid('batch_id')->index();

            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->enum('status', ['pending', 'confirmed', 'attended', 'absent', 'cancelled'])->default('pending');

            $table->decimal('price', 10, 2)->default(0);
            $table->timestamp('attended_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'session_id']);
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
