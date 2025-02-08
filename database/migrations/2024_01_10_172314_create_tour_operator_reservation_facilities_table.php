<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorReservationFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facility_name');
            $table->string('facility_description');
            $table->unsignedBigInteger('tour_operator_reservation_id');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('reservation_facilities', function (Blueprint $table) {
            $table->foreign('tour_operator_reservation_id')->references('id')->on('tour_operator_reservation')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_facilities');
    }
}
