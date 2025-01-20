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
        Schema::table('participants', function (Blueprint $table) {
            $table->boolean('is_registered_as_user')->default(FALSE)->comment('Menandakan participant ini terdaftar sebagai user atau bukan di sistem');
            $table->integer('user_id_identifier')->nullable()->comment('Kalau is_registered_as_user =true , ini menunjukkan user_id pada sistem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('is_registered_as_user');
            $table->dropColumn('user_id_identifier');
        });
    }
};
