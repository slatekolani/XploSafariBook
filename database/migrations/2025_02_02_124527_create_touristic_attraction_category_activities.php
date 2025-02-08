<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicAttractionCategoryActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('touristic_attraction_category_id');
            $table->unsignedBigInteger('touristic_activities_id');
            $table->timestamps();
        });
        Schema::table('category_activities',function(Blueprint $table)
        {
            $table->foreign('touristic_attraction_category_id')->references('id')->on('touristic_attraction_category')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('touristic_activities_id')->references('id')->on('touristic_activities')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touristic_attraction_category_activities');
    }
}
