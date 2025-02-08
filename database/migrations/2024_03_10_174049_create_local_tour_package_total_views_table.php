<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageTotalViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_tour_package_total_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('ip_address');
            $table->unsignedBigInteger('local_tour_package_id');
            $table->timestamps();
        });
        Schema::table('local_tour_package_total_views',function (Blueprint $table){
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
        Schema::dropIfExists('local_tour_package_total_views');
    }
}
