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
        Schema::table('umrah_batches', function (Blueprint $table) {
            $table->date('return_schedule')->after('departure_schedule')->nullable()->comment('tanggal kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umrah_batches', function (Blueprint $table) {
            $table->dropColumn('return_schedule');
        });
    }
};
