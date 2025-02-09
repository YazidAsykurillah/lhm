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
        Schema::create('live_stream_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('platform_account_id');
            $table->date('live_stream_date');
            $table->dateTime('started_time', precision: 0);
            $table->dateTime('stoped_time', precision: 0);
            $table->decimal('sales_turn_over', total: 12, places: 2)->default(0)->comment('Omset Penjualan selama sesi live streaming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_stream_activities');
    }
};
