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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->text('description')->nullable();

            $table->string('street')->nullable();

            $table->string('apartment')->nullable();

            $table->string('number')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();//for coordinates
            
            $table->decimal('longitude', 10, 7)->nullable();//for coordinates

            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->restrictOnDelete();

            $table->foreignId('location_type_id')
                ->nullable()
                ->constrained('location_types')
                ->restrictOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
