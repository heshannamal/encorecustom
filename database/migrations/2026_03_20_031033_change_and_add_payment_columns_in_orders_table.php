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
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('total_amount', 'sub_total');
            $table->decimal('shipping_fee', 10, 2)->default(0.00)->after('fulfillment_status');
            $table->decimal('sales_tax', 10, 2)->default(0.00)->after('shipping_fee');
            $table->decimal('invoice_total', 10, 2)->after('sales_tax');
            $table->decimal('other_fee', 10, 2)->default(0.00)->after('invoice_total');
            $table->decimal('balance_invoice', 10, 2)->after('other_fee');
            $table->decimal('processing_fee', 10, 2)->default(0.00)->after('balance_invoice');
            $table->decimal('paid_amount', 10, 2)->after('processing_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('sub_total', 'total_amount');
            $table->dropColumn('shipping_fee');
            $table->dropColumn('sales_tax');
            $table->dropColumn('invoice_total');
            $table->dropColumn('other_fee');
            $table->dropColumn('balance_invoice');
            $table->dropColumn('processing_fee');
            $table->dropColumn('paid_amount');
        });
    }
};
