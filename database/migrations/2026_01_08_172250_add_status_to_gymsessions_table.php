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
        Schema::table('gymsessions', function (Blueprint $table) {
            $table->enum('status', ['pending', 'started', 'ended', 'cancelled'])
                  ->default('pending')
                  ->after('end_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gymsessions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
