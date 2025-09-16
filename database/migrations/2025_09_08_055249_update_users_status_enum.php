<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // Step 1: Allow active + rejected in ENUM
        DB::statement("ALTER TABLE `users` MODIFY `status` ENUM('pending','approved','inactive','active','rejected') NOT NULL DEFAULT 'pending'");

        // Step 2: Update old approved → active
        DB::statement("UPDATE `users` SET `status` = 'active' WHERE `status` = 'approved'");

        // Step 3: Now drop 'approved' from ENUM
        DB::statement("ALTER TABLE `users` MODIFY `status` ENUM('pending','active','inactive','rejected') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Step 1: Restore approved into ENUM
        DB::statement("ALTER TABLE `users` MODIFY `status` ENUM('pending','approved','inactive','rejected') NOT NULL DEFAULT 'pending'");

        // Step 2: Convert active → approved
        DB::statement("UPDATE `users` SET `status` = 'approved' WHERE `status` = 'active'");

        // Step 3: Drop active from ENUM
        DB::statement("ALTER TABLE `users` MODIFY `status` ENUM('pending','approved','inactive') NOT NULL DEFAULT 'pending'");
    }
};
