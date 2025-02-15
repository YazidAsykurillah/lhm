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
        Schema::create('payment_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Name of the payment / description');
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount', total: 12, places: 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_notes');
    }
};
