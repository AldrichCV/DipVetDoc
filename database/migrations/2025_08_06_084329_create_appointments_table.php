<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This anonymous class defines the migration for creating the 'appointments' table
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is called when the migration is executed.
     */
    public function up(): void
    {
        // Create the 'appointments' table
        Schema::create('appointments', function (Blueprint $table) {

            // Primary key column (auto-incrementing ID)
            $table->id();

            // Foreign key referencing the 'users' table
            $table->unsignedBigInteger('user_id');

            // Pet name for the appointment (string data type)
            $table->string('pet_name');

            // The service being requested (e.g., grooming, checkup)
            $table->string('service');

            // The date of the appointment
            $table->date('appointment_date');

            // The time of the appointment
            $table->time('appointment_time');

            // Optional notes provided by the user
            $table->text('notes')->nullable();

            // Status of the appointment - default is 'pending'
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');

            // Adds created_at and updated_at timestamp columns
            $table->timestamps();

            // Define foreign key constraint: when the user is deleted, appointments are also deleted
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * This method is called when the migration is rolled back.
     */
    public function down(): void
    {
        // Drop the 'appointments' table if it exists
        Schema::dropIfExists('appointments');
    }
};
