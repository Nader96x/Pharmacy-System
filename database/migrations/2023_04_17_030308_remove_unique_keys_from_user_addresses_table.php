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
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            // Drop unique constraint
            $table->dropUnique(['user_id', 'is_main']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            // Add back foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');

            // Add back unique constraint
            $table->unique(['user_id', 'is_main']);
        });
    }
};
