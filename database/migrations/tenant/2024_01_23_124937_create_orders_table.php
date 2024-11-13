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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('mobile')->nullable();
            $table->float('shipping')->nullable();
            $table->foreignId('address_id')->nullable()->constrained('addresses');
            $table->integer('delivery_status')->default(1);
            $table->foreignId('delivery_id')->nullable()->references('id')->on('users');
            $table->integer('payment_method')->default(1);
            $table->float('total_discount')->default(0);
            $table->float('total_gst')->default(0);
            $table->float('total')->default(0);
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');
            $table->foreignId('cashier_id')->nullable()->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
