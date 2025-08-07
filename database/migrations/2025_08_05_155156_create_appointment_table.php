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
       Schema::create('vet_appointments', function (Blueprint $table) {
        $table->id();
        $table->integer('pet_id');
        $table->integer('client_id');
        $table->integer('vet_id')->nullable();
        $table->date('appointment_date');
        $table->time('appointment_time');
        $table->string('reason');
        $table->text('notes')->nullable();
        $table->string('status')->default('scheduled');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
