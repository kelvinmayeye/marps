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
        Schema::create('exam_subject_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_registration_student_id');
            $table->string('student_prem_number');
            $table->unsignedBigInteger('exam_registration_id');
            $table->unsignedBigInteger('exam_id');
            $table->string('exam_name')->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->string('subject_name')->nullable();
            $table->integer('score')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_subject_scores');
    }
};
