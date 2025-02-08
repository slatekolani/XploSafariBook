<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTouristicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_touristic_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('touristic_activities_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('company_touristic_activities',function(Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('company_touristic_activities');
    }
}
