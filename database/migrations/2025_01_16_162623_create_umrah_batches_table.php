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
        Schema::create('umrah_batches', function (Blueprint $table) {
            $table->id();
            $table->string('code_batch')->unique();
            $table->string('name');
            $table->date('departure_schedule')->comments('Tanggal keberangkatan');
            $table->text('description');
            $table->enum('availability',['available', 'unavailable']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umrah_batches');
    }
};
