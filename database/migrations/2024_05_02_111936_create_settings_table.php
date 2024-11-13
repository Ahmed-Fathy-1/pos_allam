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
		Schema::create('settings', function(Blueprint $table) {
            $table->id();
            //logo
			$table->string('image');
			$table->string('email');

			$table->string('facebook_link');
			$table->string('twitter_link');
			$table->string('whatsapp_link');
			$table->string('pinterest_link');
			$table->string('youtube_link');
			$table->string('instagram_link');
			$table->string('reddit_link');
			$table->string('linkedin_link');

            //addresses and phones in footer
            $table->string('footer_image');
			$table->string('desc');
			$table->string('copyright');

            $table->string('phone');
			$table->string('address');

            $table->softDeletes();
			$table->timestamps();
		});
	}

   /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
