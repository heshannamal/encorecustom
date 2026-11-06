<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed a few common transaction types
        DB::table('inventory_transaction_types')->insert([
            [
                'name' => 'Inventory In',
                'slug' => 'inventory_order_in',
                'description' => 'Stock received into the inventory from an inventory order',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shop Purchase',
                'slug' => 'shop_purchase',
                'description' => 'Stock deducted via shop purchase',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Online Purchase',
                'slug' => 'online_purchase',
                'description' => 'Stock deducted via online purchase',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Transfer Out',
                'slug' => 'transfer_out',
                'description' => 'Stock moved out from an inventory type',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Transfer In',
                'slug' => 'transfer_in',
                'description' => 'Stock received into an inventory type',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adjustment Add',
                'slug' => 'adjustment_add',
                'description' => 'Manual increase to stock',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adjustment Deduct',
                'slug' => 'adjustment_deduct',
                'description' => 'Manual decrease to stock',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transaction_types');
    }
};


