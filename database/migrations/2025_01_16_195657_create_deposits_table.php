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
        Schema::create('deposits', function (Blueprint $table){
            $table->id();
            $table->integer('user_id')->comment('Relation to User model');
            $table->decimal('amount', total:12, places:2)->default(0)->comment('Nilai deposito yang dimiliki user');
            $table->boolean('is_active')->default(TRUE)->comment('status deposito apakah dibekukan atau tidak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
