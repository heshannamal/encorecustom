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
        Schema::table('roles', function (Blueprint $table) {
            $table->tinyInteger('is_active')->default(1)->after('guard_name')->comment('0=inactive, 1=active');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->tinyInteger('is_active')->default(1)->after('guard_name')->comment('0=inactive, 1=active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
