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
        Schema::create('meta_seos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('canonical_url')->nullable();
            $table->json('keyword')->nullable();
            $table->text('description')->nullable();
            $table->longText('schema_markup')->nullable();
            $table->integer('page_id')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_seos');
    }
};
