<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaRegionPrecautionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanzania_region_precaution', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('precaution_title');
            $table->string('precaution_description');
            $table->unsignedBigInteger('tanzania_region_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tanzania_region_precaution',function (Blueprint $table){
            $table->foreign('tanzania_region_id')->references('id')->on('tanzania_region')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanzania_region_precaution');
    }
}
