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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->integer('umrah_manifest_id')->comments('relation to UmrahManifest model');
            $table->string('name')->comments('nama jamaah');
            $table->string('phone_number')->nullable();
            $table->enum('gender',['Male','Female']);
            $table->text('address');
            $table->string('ktp_number')->comments('nomor KTP')->nullable();
            $table->string('passport_number')->comments('nomor Passport')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
