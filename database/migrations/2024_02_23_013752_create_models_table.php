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
        Schema::create('models', function (Blueprint $table) {
            $table->id('models_id');
            $table->string('name');
            $table->string('body_style');
            $table->timestamps();

            // Add foreign key for 'options_id'
            $table->unsignedBigInteger('options_id');
            $table->foreign('options_id')->references('options_id')->on('options');

            // Add foreign key for 'suppliers_id'
            $table->unsignedBigInteger('suppliers_id');
            $table->foreign('suppliers_id')->references('suppliers_id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
