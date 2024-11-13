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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('limit')->nullable();
            $table->boolean('status')->default(1);
            $table->integer("n_usage")->default(0);
            $table->integer('discount');
            $table->dateTime ('start_at');
            $table->dateTime ('end_at');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
