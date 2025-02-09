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
        Schema::create('live_stream_activity_approvals', function (Blueprint $table) {
            $table->id();
            $table->integer('live_stream_activity_id');
            $table->boolean('is_approved')->default(FALSE);
            $table->integer('approver_id')->nullable();
            $table->date('approval_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_stream_activity_approvals');
    }
};
