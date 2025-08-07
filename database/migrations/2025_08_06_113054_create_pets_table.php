<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Anonymous class for the migration
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is called when you run `php artisan migrate`.
     * It creates the 'pets' table with specified columns and relationships.
     */
    public function up(): void
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->id(); // Primary key: auto-incrementing ID

            // Foreign key column referencing the 'id' in 'users' table
            $table->foreignId('user_id')
                ->constrained() // Shorthand for referencing 'id' on 'users' table
                ->onDelete('cascade'); // If user is deleted, delete their pets too

            $table->string('name'); // Name of the pet
            $table->string('species'); // Species of the pet (e.g., dog, cat)
            $table->string('breed')->nullable(); // Breed of the pet (nullable)
            $table->integer('age'); // Age of the pet
            $table->string('gender'); // Gender of the pet (e.g., male, female)

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is called when you run `php artisan migrate:rollback`.
     * It deletes the 'pets' table if it exists.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet'); // Drops the pets table
    }
};
