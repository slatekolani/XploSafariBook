<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_package_transport', function (Blueprint $table) {
            $table->unsignedBigInteger('local_tour_package_id');
            $table->unsignedBigInteger('transport_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_package_transport',function (Blueprint $table)
        {
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE');
            $table->foreign('transport_id')->references('id')->on('transports')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_package_transport');
    }
}
