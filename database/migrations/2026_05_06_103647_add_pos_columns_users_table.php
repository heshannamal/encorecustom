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
            $table->integer('is_pos_admin')->nullable()->after('is_social')->comment('1 = Yes, any other = No');
            $table->integer('is_pos_customer')->nullable()->after('is_pos_admin')->comment('1 = Yes, any other = No');
            $table->integer('mobile')->nullable()->after('email');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_pos_customer');
            $table->dropColumn('is_pos_admin');
            $table->dropColumn('mobile');
        });
    }
};
