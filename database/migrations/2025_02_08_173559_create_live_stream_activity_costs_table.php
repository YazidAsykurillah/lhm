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
        Schema::create('live_stream_activity_costs', function (Blueprint $table) {
            $table->id();
            $table->integer('live_stream_activity_id');
            $table->decimal('streamer_rate', total: 12, places: 2)->default(0)->comment('get from the rate per hour of the the live streamer');
            $table->decimal('total_hour', total:8, places:2 )->default(0);
            $table->decimal('total_cost')->default(0)->comment('resulted from streamer_rate * total_hour');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_stream_activity_costs');
    }
};
