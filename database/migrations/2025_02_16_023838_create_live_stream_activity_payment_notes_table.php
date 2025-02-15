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
        Schema::create('live_stream_activity_payment_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('live_stream_activity_id');
            $table->integer('payment_note_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_stream_activity_payment_notes');
    }
};
