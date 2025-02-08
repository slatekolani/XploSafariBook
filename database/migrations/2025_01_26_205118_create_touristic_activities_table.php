<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity_name');
            $table->longText('activity_description');
            $table->string('activity_image');
            $table->string('best_activity_period');
            $table->longText('basic_information');
            $table->string('uuid',100);
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
        Schema::dropIfExists('touristic_activities');
    }
}
