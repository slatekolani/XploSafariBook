<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTourBookingReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_tour_booking_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('touristic_attraction_id');
            $table->string('tour_operator_reservation_id');
            $table->string('uuid',100);
            $table->unsignedBigInteger('custom_tour_booking_id');
            $table->timestamps();
        });
        Schema::table('custom_tour_booking_reservations',function (Blueprint $table){
            $table->foreign('custom_tour_booking_id')->references('id')->on('custom_tour_booking')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_tour_booking_reservations');
    }
}
