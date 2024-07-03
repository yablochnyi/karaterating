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
        Schema::create('organizate_puli_list_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained('tournament_student_lists');
            $table->foreignId('student_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizate_puli_list_students');
    }
};
