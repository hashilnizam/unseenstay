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
            $table->id();
            $table->string('order_id');
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_order_id');
            $table->integer('status');
            $table->timestamps();


        });
    }

        public function down(): void
    {
        Schema::dropIfExists('payments');
    }

};
