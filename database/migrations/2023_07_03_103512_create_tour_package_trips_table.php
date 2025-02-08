<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPackageTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_package_trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day_number');
            $table->string('safari_trip_name');
            $table->string('safari_trip_description');
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('tour_package_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_package_trips',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tour_package_id')->references('id')->on('tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_package_trips');
    }
}
