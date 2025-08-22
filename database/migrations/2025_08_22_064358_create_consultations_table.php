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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('user_id'); // pet owner
            $table->unsignedBigInteger('vet_id')->nullable(); // vet who handled consultation
            $table->unsignedBigInteger('pet_id')->nullable();

            // Consultation details
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('appointment_id')->references('id')->on('user_appointments')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vet_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
