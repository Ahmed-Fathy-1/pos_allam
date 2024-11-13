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
        Schema::create('package_details', function (Blueprint $table) {
            $table->id();

            $table->float('Price_monthly');
            $table->float('Price_annually');

            $table->float('storage_monthly'); // storage
            $table->float('storage_annually');

            $table->boolean('interactive_archives')->default(false); // landing
            $table->boolean('custom_branding')->default(false); // logo

            $table->boolean('messages')->default(false); // chat
            $table->boolean('notifications')->default(false);

            $table->boolean('priority')->default(true); // support

            $table->boolean('main_show')->default(false);
            $table->boolean('main_search')->default(false);

            $table->boolean('statics')->default(false);

            $table->foreignId('package_id')->constrained('packages')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_details');
    }
};
