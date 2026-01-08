<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('apartment')->nullable();
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            $table->boolean('is_principal')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("
            CREATE UNIQUE INDEX unique_principal_address
            ON addresses (addressable_type, addressable_id)
            WHERE is_principal = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS unique_principal_address");
        Schema::dropIfExists('addresses');
    }
};
