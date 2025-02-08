<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicAttractionVisitAdvicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attraction_visit_advices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('advice_number');
            $table->string('advice_title');
            $table->longText('advice_description');
            $table->unsignedBigInteger('touristic_attraction_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('attraction_visit_advices',function (Blueprint $table){
            $table->foreign('touristic_attraction_id')->references('id')->on('touristic_attraction')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touristic_attraction_visit_advices');
    }
}
