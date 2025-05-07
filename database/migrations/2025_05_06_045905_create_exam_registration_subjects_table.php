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
        Schema::create('exam_registration_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_registration_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('subject_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_registration_subjects');
    }
};
