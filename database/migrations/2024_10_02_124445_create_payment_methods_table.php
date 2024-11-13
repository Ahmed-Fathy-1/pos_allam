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
        Schema::create('payment_methods', function (Blueprint $table) {
        $table->id();
        $table->string('name_ar');
        $table->string('name_en');
        $table->string('image')->nullable();
        $table->enum('status', ['1', '0'])->default('0');
        $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
        $table->softDeletes();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
