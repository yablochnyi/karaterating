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
        Schema::create('tournament_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('manage_tournaments')->onDelete('cascade')->nullOnDelete();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade')->nullOnDelete();
            $table->boolean('is_success')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_students');
    }
};
