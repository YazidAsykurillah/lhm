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
            $table->string('photo_file')->nullable();
            $table->string('ktp_number')->nullable();
            $table->string('ktp_file')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo_file');
            $table->dropColumn('ktp_number');
            $table->dropColumn('ktp_file');
            $table->dropColumn('passport_number');
            $table->dropColumn('passport_file');
        });
    }
};
