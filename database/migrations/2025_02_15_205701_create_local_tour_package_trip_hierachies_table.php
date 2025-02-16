<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageTripHierachiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_trip_hierachies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day')->nullable();
            $table->string('travel_date')->nullable();
            $table->string('destination')->nullable();
            $table->string('reservation')->nullable();
            $table->unsignedBigInteger('local_tour_package_id');
            $table->string('uuid',100);
            $table->timestamps();
        });
        Schema::table('package_trip_hierachies', function (Blueprint $table){
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_tour_package_trip_hierachies');
    }
}
