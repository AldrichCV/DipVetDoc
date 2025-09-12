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
        Schema::table('user_appointments', function (Blueprint $table) {
             // Change reason from string to unsignedBigInteger (or integer if you prefer)
            $table->unsignedBigInteger('reason')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_appointments', function (Blueprint $table) {
            $table->string('reason')->change();
        });
    }
};
