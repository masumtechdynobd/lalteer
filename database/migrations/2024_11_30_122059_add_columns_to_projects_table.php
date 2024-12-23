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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('projects_aim_photo')->nullable(); // For storing project aim photo path
            $table->string('projects_aim_title')->nullable(); // For storing project aim title
            $table->text('objectives')->nullable(); // For project objectives
            $table->text('partnership')->nullable(); // For project partnership details
            $table->text('key_info')->nullable(); // For key project info
            $table->text('key_highlight')->nullable(); // For project highlights
            $table->text('key_achievement')->nullable(); // For project achievements
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'projects_aim_photo',
                'projects_aim_title',
                'objectives',
                'partnership',
                'key_info',
                'key_highlight',
                'key_achievement',
            ]);
        });
    }
};