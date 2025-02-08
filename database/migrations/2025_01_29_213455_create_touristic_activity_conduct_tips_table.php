<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicActivityConductTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_activity_conduct_tips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tip_name');
            $table->longText('tip_description');
            $table->string('uuid',100);
            $table->unsignedBigInteger('touristic_activities_id');
            $table->timestamps();
        });
        Schema::table('touristic_activity_conduct_tips',function(Blueprint $table){
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
        Schema::dropIfExists('touristic_activity_conduct_tips');
    }
}
