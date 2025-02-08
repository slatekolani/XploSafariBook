<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorTanzaniaRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_tanzania_region', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('tanzania_region_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('operator_tanzania_region',function (Blueprint $table)
        {
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE');
            $table->foreign('tanzania_region_id')->references('id')->on('tanzania_region')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_tanzania_region');
    }
}
