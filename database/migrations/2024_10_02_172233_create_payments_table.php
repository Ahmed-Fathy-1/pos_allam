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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('package_id')->nullable()->constrained('packages')->cascadeOnDelete();
            $table->float('amount');
            $table->string('receipt')->nullable();
            $table->char('currency',3)->default('EGP');
            $table->string('methods')->nullable();
            $table->enum('status',['pending','completed'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->json('transaction_data')->nullable();
            
            // domain name
            $table->string('domain_name');

            $table->softDeletes(); // Adds 'deleted_at' column
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
