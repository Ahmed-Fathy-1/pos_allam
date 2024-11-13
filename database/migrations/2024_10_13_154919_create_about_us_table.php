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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('intro_title');
            $table->text('intro_desc');
            $table->string('numbers_clients_title')->nullable();
            $table->string('numbers_clients_count')->nullable();
            $table->string('numbers_downloads_title')->nullable();
            $table->string('numbers_downloads_count')->nullable();
            $table->string('numbers_projects_title')->nullable();
            $table->string('numbers_projects_count')->nullable();
            $table->string('workflow_title')->nullable();
            $table->text('workflow_desc')->nullable();
            $table->string('workflow_download_title')->nullable();
            $table->text('workflow_download_desc')->nullable();
            $table->string('workflow_download_number')->nullable();
            $table->string('workflow_download_image')->nullable();
            $table->string('workflow_manage_title')->nullable();
            $table->string('workflow_manage_desc')->nullable();
            $table->string('workflow_manage_number')->nullable();
            $table->string('workflow_manage_image')->nullable();
            $table->string('workflow_edit_title')->nullable();
            $table->text('workflow_edit_desc')->nullable();
            $table->string('workflow_edit_number')->nullable();
            $table->string('workflow_edit_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
