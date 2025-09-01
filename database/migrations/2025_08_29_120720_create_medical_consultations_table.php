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
        Schema::create('medical_consultations', function (Blueprint $table) {
             $table->id();

            // Relations
            $table->foreignId('pet_id')->constrained('pets')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('vet_id')->nullable()->constrained('users')->nullOnDelete();

            // Consultation details
            $table->decimal('body_weight', 5, 2)->nullable();       // e.g. 12.50 kg
            $table->integer('respiratory_rate')->nullable();         // breaths/min
            $table->decimal('temperature', 4, 1)->nullable();        // °C
            $table->text('complaint')->nullable();
            $table->text('medication')->nullable();
            $table->text('prescription')->nullable();

            // Consultation meta
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_consultations');
    }
};
