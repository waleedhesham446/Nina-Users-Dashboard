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
            $table->index('first_name');
            $table->index('last_name');
            $table->index('email');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->index('country');
            $table->index('city');
            $table->index('post_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['first_name']);
            $table->dropIndex(['last_name']);
            $table->dropIndex(['email']);
        });
        
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropIndex(['country']);
            $table->dropIndex(['city']);
            $table->dropIndex(['post_code']);
        });
    }
};
