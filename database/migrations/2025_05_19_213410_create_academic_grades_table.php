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
        Schema::create('academic_grades', function (Blueprint $table) {
            $table->id();
            $table->string('grade'); // e.g., A, B+, C
            $table->decimal('min_score', 5, 2); // e.g., 80.00
            $table->decimal('max_score', 5, 2); // e.g., 100.00
            $table->decimal('points', 3, 2)->nullable(); // e.g., 4.00
            $table->string('remarks')->nullable(); // e.g., Excellent, Good, etc.
            $table->timestamps();

            $table->unique('grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_grades');
    }
};
