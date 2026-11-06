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
        Schema::table('shipping_labels', function (Blueprint $table) {
            $table->tinyInteger('is_shipped')->default(0)->after('label_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipping_labels', function (Blueprint $table) {
            $table->dropColumn('is_shipped');
        });
    }
};
