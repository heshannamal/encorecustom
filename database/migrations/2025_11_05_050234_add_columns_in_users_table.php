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
            $table->text('temp_password')->nullable()->after('password');
            $table->text('profile_pic')->nullable()->after('remember_token');
            $table->integer('inventory_id')->after('profile_pic');
            $table->tinyInteger('is_customer')->default(0)->after('inventory_id');
            $table->tinyInteger('is_profile_complete')->default(0)->after('is_customer');
            $table->tinyInteger('is_social')->default(0)->after('is_profile_complete');
            $table->tinyInteger('is_active')->default(1)->after('is_social');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('temp_password');
            $table->dropColumn('profile_pic');
            $table->dropColumn('inventory_id');
            $table->dropColumn('is_customer');
            $table->dropColumn('is_profile_complete');
            $table->dropColumn('is_social');
            $table->dropColumn('is_active');
            $table->dropSoftDeletes();
        });
    }
};
