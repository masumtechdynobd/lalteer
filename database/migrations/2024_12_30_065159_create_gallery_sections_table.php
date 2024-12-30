<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the media
            $table->string('image'); // Path to store the main image (single file)
            $table->json('multiple_images')->nullable(); // JSON to store multiple image file paths
            $table->json('multiple_videos')->nullable(); // JSON to store multiple video file paths
            $table->enum('status', ['1', '0'])->default('1'); // Status (1: Active, 0: Inactive)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_sections');
    }
};
