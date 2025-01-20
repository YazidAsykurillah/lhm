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
        Schema::create('saving_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('Relation to user model');
            $table->string('transaction_source')->comment('Sumber transaksi, misal: bank, alfamart indomaret atau lainnya');
            $table->string('sender_name')->comment('Nama pada rekening pengirim');
            $table->integer('bank_account_id')->comment('Tujuan bank transaksi');
            $table->decimal('amount', total:12, places:2)->default(0);
            $table->date('transaction_date')->comment('Tanggal transfer');
            $table->string('transaction_receipt')->comment('Resi Transaksi')->nullable();
            $table->boolean('is_confirmed')->default(FALSE);
            $table->integer('confirmator_id')->nullable()->comment('Relation to User Model, user yang mengkonfirmasi bukti transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_transactions');
    }

};
