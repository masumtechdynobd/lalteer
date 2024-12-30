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
        Schema::create('newsletter_direct_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video');  // Path to store the uploaded video file
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
        Schema::dropIfExists('newsletter_direct_videos');
    }
};
