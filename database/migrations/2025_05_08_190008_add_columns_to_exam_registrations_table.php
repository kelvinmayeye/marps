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
        Schema::table('exam_registrations', function (Blueprint $table) {
            $table->integer('total_students')->after('status')->default(0);
            $table->boolean('student_confirmed')->default(0)->after('status');
            $table->unsignedBigInteger('approved_by')->after('created_by')->nullable();
            $table->timestamp('approved_at')->after('approved_by')->nullable();
            $table->boolean('student_scores_uploaded')->default(0)->after('approved_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_registrations', function (Blueprint $table) {
            $table->dropColumn(['total_students','student_confirmed','approved_by','approved_at','student_scores_uploaded']);
        });
    }
};
