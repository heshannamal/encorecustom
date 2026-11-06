<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('packing_slips', function (Blueprint $table) {
            $table->timestamp('order_created_at')->nullable()->after('order_id');
            $table->string('customer_first_name')->nullable()->after('order_created_at');
            $table->string('customer_last_name')->nullable()->after('customer_first_name');
            $table->string('customer_phone_number')->nullable()->after('customer_last_name');
            $table->string('customer_email')->nullable()->after('customer_phone_number');

            $table->integer('shipping_method_id')->nullable()->after('customer_email');
            $table->string('shipping_first_name')->nullable()->after('shipping_method_id');
            $table->string('shipping_last_name')->nullable()->after('shipping_first_name');
            $table->string('shipping_street')->nullable()->after('shipping_last_name');
            $table->string('shipping_city')->nullable()->after('shipping_street');
            $table->string('shipping_state')->nullable()->after('shipping_city');
            $table->string('shipping_postal_code')->nullable()->after('shipping_state');
            $table->string('shipping_country')->nullable()->after('shipping_postal_code');

            $table->string('billing_first_name')->nullable()->after('shipping_country');
            $table->string('billing_last_name')->nullable()->after('billing_first_name');
            $table->string('billing_street')->nullable()->after('billing_last_name');
            $table->string('billing_city')->nullable()->after('billing_street');
            $table->string('billing_state')->nullable()->after('billing_city');
            $table->string('billing_postal_code')->nullable()->after('billing_state');
            $table->string('billing_country')->nullable()->after('billing_postal_code');

            $table->integer('store_id')->nullable()->after('billing_country');
            $table->string('store_name')->nullable()->after('store_id');
            $table->string('store_code')->nullable()->after('store_name');

            $table->integer('order_item_count')->nullable()->after('store_code');

            $table->string('dealer_email')->nullable()->after('order_item_count');
            $table->string('dealer_phone_number')->nullable()->after('dealer_email');
            $table->string('dealer_website')->nullable()->after('dealer_phone_number');

            $table->text('slip_text')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packing_slips', function (Blueprint $table) {
            $table->dropColumn([
                'order_created_at',
                'customer_first_name',
                'customer_last_name',
                'customer_phone_number',
                'customer_email',
                'shipping_method_id',
                'shipping_first_name',
                'shipping_last_name',
                'shipping_street',
                'shipping_city',
                'shipping_state',
                'shipping_postal_code',
                'shipping_country',
                'billing_first_name',
                'billing_last_name',
                'billing_street',
                'billing_city',
                'billing_state',
                'billing_postal_code',
                'billing_country',
                'store_id',
                'store_name',
                'store_code',
                'order_item_count',
                'dealer_email',
                'dealer_phone_number',
                'dealer_website'
            ]);
        });
    }
};
