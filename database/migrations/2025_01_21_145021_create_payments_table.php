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
        Schema::create('payments', function (Blueprint $table) {
            $table->id("id_payments");
            $table->unsignedBigInteger('order_id');
            $table->enum('payment_method', ['bank_transfer', 'e-wallet']);
            $table->enum('payment_status', ['successful', 'failed']);
            $table->timestamp('payment_date');

            $table->foreign('order_id')->references('id_order')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
