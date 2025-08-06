<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This is an anonymous migration class that defines the structure of multiple tables.
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method will be executed when you run `php artisan migrate`.
     * It creates the 'users', 'password_reset_tokens', and 'sessions' tables.
     */
    public function up(): void
    {
        // Create the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (bigint)
            $table->string('name'); // Name of the user
            $table->string('email')->unique(); // Unique email address
            $table->timestamp('email_verified_at')->nullable(); // Timestamp for when the email was verified
            $table->string('password'); // Encrypted user password
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Adds created_at and updated_at columns
        });

        // Create the 'password_reset_tokens' table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email is the primary key
            $table->string('token'); // Reset token
            $table->timestamp('created_at')->nullable(); // Timestamp when the token was created
        });

        // Create the 'sessions' table for session management
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID is the primary key
            $table->foreignId('user_id')->nullable()->index(); // Foreign key to the users table (optional)
            $table->string('ip_address', 45)->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // Browser or client user agent info
            $table->longText('payload'); // Serialized session data
            $table->integer('last_activity')->index(); // Timestamp of last activity for session timeout
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method will be executed when you run `php artisan migrate:rollback`.
     * It drops the tables created in the `up()` method.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drops 'users' table
        Schema::dropIfExists('password_reset_tokens'); // Drops 'password_reset_tokens' table
        Schema::dropIfExists('sessions'); // Drops 'sessions' table
    }
};
