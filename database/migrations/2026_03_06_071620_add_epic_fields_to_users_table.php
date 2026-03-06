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
        Schema::table('users', function (Blueprint $table) {
            $table->string('epic_id')->nullable()->unique()->after('steam_avatar');
            $table->string('epic_display_name')->nullable()->after('epic_id');
            $table->string('epic_name')->nullable()->after('epic_display_name');
            $table->string('epic_avatar')->nullable()->after('epic_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['epic_id', 'epic_display_name', 'epic_name', 'epic_avatar']);
        });
    }
};
