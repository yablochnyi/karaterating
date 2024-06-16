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
        Schema::create('coach_tournaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->nullOnDelete();
            $table->foreignId('tournament_id')->constrained('manage_tournaments')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coach_tournaments');
    }
};
