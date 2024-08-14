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
        Schema::table('manage_tournaments', function (Blueprint $table) {
            $table->string('regulation_document')->nullable();
            $table->string('application_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manage_tournaments', function (Blueprint $table) {
            $table->dropColumn('regulation_document');
            $table->dropColumn('application_document');
        });
    }
};
