<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->string('title');  // Title of the URL
            $table->string('link');   // Original URL
            $table->string('shortLink')->unique();  // Shortened URL
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // User reference, assuming there's a users table
            $table->timestamps();  // Created at and updated at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('short_urls');
    }
}
