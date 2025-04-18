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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->change();
            $table->dropColumn('email_verified_at');
            $table->string('title')->after('password')->nullable();
            $table->integer('school_id')->after('title')->nullable();
            $table->string('school_position',256)->after('school_id')->nullable();
            $table->string('phone_number',16)->after('school_position')->nullable();
            $table->enum('status',['pending','rejected','accepted','suspended','active','archived'])->after('phone_number')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->change();
            $table->timestamp('email_verified_at')->after('password')->nullable();
            $table->dropColumn([
                'title',
                'school_id',
                'school_position',
                'phone_number',
                'status',
            ]);
        });
    }
};
