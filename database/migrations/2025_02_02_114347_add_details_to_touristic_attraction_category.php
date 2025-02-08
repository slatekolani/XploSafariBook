<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToTouristicAttractionCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('touristic_attraction_category', function (Blueprint $table) {
            $table->string('attraction_category_iconic_image');
            $table->longText('attraction_category_basic_information');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('touristic_attraction_category', function (Blueprint $table) {
            Schema::dropIfExists('touristic_attraction_category');
        });
    }
}
