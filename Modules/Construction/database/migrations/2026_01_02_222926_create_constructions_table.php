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
        Schema::create('constructions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 50)->nullable();
            $table->foreignId('construction_type_id')->constrained('construction_types');
            $table->enum('status', ['planned', 'in_progress', 'completed'])->default('planned'); //ENUM PHP A FUTURO
            $table->date('start_date')->nullable();
            $table->date('estimated_end_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->text('description')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('progress', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constructions');
    }
};
