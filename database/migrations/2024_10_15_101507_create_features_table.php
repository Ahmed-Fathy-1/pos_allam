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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('main_title');
            $table->string('main_description');
            $table->string('feature_1_title');
            $table->string('feature_1_image');
            $table->string('feature_1_description');
            $table->string('feature_2_title');
            $table->string('feature_2_image');
            $table->string('feature_2_description');
            $table->string('feature_3_title');
            $table->string('feature_3_image');
            $table->string('feature_3_description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('super_admin_features');
    }
};
