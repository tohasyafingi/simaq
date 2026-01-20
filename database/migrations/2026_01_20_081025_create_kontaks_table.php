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
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->text('about')->nullable(); 
            $table->text('alamat')->nullable();
            $table->text('telepon')->nullable();
            $table->text('email')->nullable();
            $table->text('google_map_embed')->nullable();
            $table->string('message_name')->nullable();
            $table->string('message_email')->nullable();
            $table->string('message_subject')->nullable();
            $table->longText('message_content')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->text('copyright')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
