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
        Schema::table('research_and_develops', function (Blueprint $table) {
            $table->string('title2')->nullable()->after('title'); // Add the column after 'title'
        });
    }

    public function down()
    {
        Schema::table('research_and_develops', function (Blueprint $table) {
            $table->dropColumn('title2'); // Remove the column when rolling back
        });
    }
};
