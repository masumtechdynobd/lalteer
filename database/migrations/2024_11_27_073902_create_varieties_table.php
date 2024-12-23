<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varieties', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('breeder_name');
            $table->string('color');
            $table->float('weight');  // Changed to float for numerical precision
            $table->decimal('rate', 8, 2);  // Changed to decimal for rate with precision and scale
            $table->string('showing_time');
            $table->decimal('yield', 8, 2);  // Changed to decimal for yield
            $table->string('maturity');

            // Reference to the 'services' table
            $table->unsignedBigInteger('crop_id');
            $table->foreign('crop_id')->references('id')->on('services')->onDelete('cascade'); // Fixed table name to 'services'

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
        Schema::dropIfExists('varieties');
    }
};
