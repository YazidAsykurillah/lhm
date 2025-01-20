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
        Schema::create('umrah_manifests', function (Blueprint $table) {
            $table->id();
            $table->integer('umrah_batch_id')->comments('relationship with UmrahBatch Model');
            $table->integer('user_id')->comments('relationship with UserID, pendaftar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umrah_manifests');
    }
};
