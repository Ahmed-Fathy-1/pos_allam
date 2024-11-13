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
        Schema::create('payment_transfers', function (Blueprint $table) {
            $table->id();
            $table->float('amount_paid');
            $table->float('total_due');
            $table->float('remaining')->default(0);
            $table->float('over_payment')->default(0);
            $table->integer('type')->default(0);
            $table->integer('payment_type');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transfers');
    }
};
