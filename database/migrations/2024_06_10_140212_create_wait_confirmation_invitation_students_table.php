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
        Schema::create('wait_confirmation_invitation_students', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('coach_id')->constrained('users')->nullOnDelete();
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wait_confirmation_invitation_students');
    }
};
