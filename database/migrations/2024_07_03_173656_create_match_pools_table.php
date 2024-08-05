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
        Schema::create('match_pools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('manage_tournaments')->cascadeOnDelete();
            $table->foreignId('list_id')->constrained('tournament_student_lists')->cascadeOnDelete();
            $table->foreignId('student1_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student2_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('winner_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('round')->default(1);
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_pools');
    }
};
