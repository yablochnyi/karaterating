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
        Schema::create('tournament_student_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age_from');
            $table->integer('age_to');
            $table->integer('weight_from');
            $table->integer('weight_to');
            $table->integer('kyu_from');
            $table->integer('kyu_to');
            $table->string('gender');
            $table->foreignId('tournament_id')->constrained('manage_tournaments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_student_lists');
    }
};
