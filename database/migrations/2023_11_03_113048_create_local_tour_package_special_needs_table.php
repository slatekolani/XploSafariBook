<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageSpecialNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_package_special_need', function (Blueprint $table) {
            $table->unsignedBigInteger('local_tour_package_id');
            $table->unsignedBigInteger('special_need_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_package_special_need',function (Blueprint $table){
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE');
            $table->foreign('special_need_id')->references('id')->on('special_needs')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_package_special_need');
    }
}
