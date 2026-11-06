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
            $table->string('order_no')->nullable()->after('order_id');
            $table->string('shipment_id')->nullable()->after('order_no');
            $table->string('shipping_name')->nullable()->after('shipment_id');
            $table->string('carrier')->nullable()->after('shipping_name');
            $table->string('selected_rate')->nullable()->after('carrier');
            $table->decimal('rate', 10, 2)->nullable()->after('selected_rate');
            $table->string('service')->nullable()->after('rate');
            $table->string('estimated_days')->nullable()->after('service');
            $table->string('tracking_object_id')->nullable()->after('estimated_days');
            $table->string('tracking_number')->nullable()->after('tracking_object_id');
            $table->text('tracking_url')->nullable()->after('tracking_number');
            $table->text('label_url')->nullable()->after('tracking_url');
            $table->tinyInteger('is_shipping_removed')->default(0)->after('label_url');
            $table->string('label_text')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipping_labels', function (Blueprint $table) {
            $table->dropColumn('order_no');
            $table->dropColumn('shipment_id');
            $table->dropColumn('shipping_name');
            $table->dropColumn('carrier');
            $table->dropColumn('selected_rate');
            $table->dropColumn('rate');
            $table->dropColumn('service');
            $table->dropColumn('estimated_days');
            $table->dropColumn('tracking_object_id');
            $table->dropColumn('tracking_number');
            $table->dropColumn('tracking_url');
            $table->dropColumn('label_url');
            $table->dropColumn('is_shipping_removed');
        });
    }
};
