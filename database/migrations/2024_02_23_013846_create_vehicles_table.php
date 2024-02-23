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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('vehicle_id');
            $table->string('VIN');
            $table->timestamps();

            // Add foreign key for 'models_id'
            $table->unsignedBigInteger('models_id');
            $table->foreign('models_id')->references('models_id')->on('models');

            // Add foreign key for 'dealers_id'
            $table->unsignedBigInteger('dealers_id');
            $table->foreign('dealers_id')->references('dealers_id')->on('dealers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
