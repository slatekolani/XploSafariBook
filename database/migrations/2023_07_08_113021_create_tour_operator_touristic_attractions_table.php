<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorTouristicAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_touristic_attraction', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('touristic_attraction_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('operator_touristic_attraction',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE');
            $table->foreign('touristic_attraction_id')->references('id')->on('touristic_attraction')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_touristic_attraction');
    }
}
