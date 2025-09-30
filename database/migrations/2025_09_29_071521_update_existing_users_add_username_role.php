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
        // Only update existing users with usernames if they don't have one
        // The columns should already exist from the previous migration
        DB::statement("UPDATE users SET username = CONCAT('user', id) WHERE username IS NULL OR username = ''");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration only updates data, so no schema changes to reverse
        // If needed, you could reset usernames to null, but it's generally not recommended
        // to reverse data changes in migrations
    }
};
