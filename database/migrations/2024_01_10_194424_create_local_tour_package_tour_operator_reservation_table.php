<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageTourOperatorReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_package_reservation', function (Blueprint $table) {
            $table->unsignedBigInteger('local_tour_package_id');
            $table->unsignedBigInteger('tour_operator_reservation_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_package_reservation',function (Blueprint $table){
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE');
            $table->foreign('tour_operator_reservation_id')->references('id')->on('tour_operator_reservation')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_package_reservation');
    }
}
