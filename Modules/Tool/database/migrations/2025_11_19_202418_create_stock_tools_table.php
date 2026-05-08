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
        Schema::create('stock_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained();
            $table->foreignId('location_id')->nullable()->constrained();
            $table->string('serial_number')->nullable();
            $table->integer('quantity');
            $table->string('status')->nullable()->default('available'); //['available', 'in_use','broken','lost','maintenance'] enum php
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_tools');
    }
};
