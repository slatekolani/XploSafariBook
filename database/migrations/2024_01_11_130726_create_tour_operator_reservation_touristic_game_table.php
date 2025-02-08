<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorReservationTouristicGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_touristic_game', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_operator_reservation_id');
            $table->unsignedBigInteger('touristic_game_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('reservation_touristic_game',function (Blueprint $table){
            $table->foreign('tour_operator_reservation_id')->references('id')->on('tour_operator_reservation')->onUpdate('CASCADE');
            $table->foreign('touristic_game_id')->references('id')->on('touristic_game')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_touristic_game');
    }
}
