<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCultureAppreciationActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appreciation_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('appreciation_activity_detail');
            $table->unsignedBigInteger('tanzania_region_culture_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('appreciation_activities', function (Blueprint $table){
            $table->foreign('tanzania_region_culture_id')->references('id')->on('tanzania_region_culture')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appreciation_activities');
    }
}
