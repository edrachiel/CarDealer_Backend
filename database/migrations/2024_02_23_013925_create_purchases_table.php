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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id('purchase_id');
            $table->timestamps();

            // Add foreign key for 'inventory_id'
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('inventory_id')->on('inventories');

            // Add foreign key for 'customers_id'
            $table->unsignedBigInteger('customers_id');
            $table->foreign('customers_id')->references('customers_id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
