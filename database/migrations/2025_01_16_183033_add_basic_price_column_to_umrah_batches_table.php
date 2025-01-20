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
            $table->decimal('basic_price', total:12, places:2)->default(0)->comment('Harga dasar/per satuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umrah_batches', function (Blueprint $table) {
            $table->dropColumn('basic_price');
        });
    }
};
