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
        Schema::create('tool_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained('tools');
            $table->foreignId('from_location_id')->nullable()->constrained('locations');
            $table->foreignId('to_location_id')->nullable()->constrained('locations');
            $table->foreignId('from_construction_id')->nullable()->constrained('constructions');
            $table->foreignId('to_construction_id')->nullable()->constrained('constructions');
            $table->string('type', 50); //(storage, assignment, transfer, repair, etc) ENUM PHP
            $table->timestamp('moved_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_movements');
    }
};
