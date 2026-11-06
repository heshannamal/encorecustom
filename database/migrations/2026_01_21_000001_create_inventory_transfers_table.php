<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('from_inventory_type_id');
            $table->integer('to_inventory_type_id');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            // $table->index(['from_inventory_type_id']);
            // $table->index(['to_inventory_type_id']);
            // $table->index(['created_by']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transfers');
    }
};


