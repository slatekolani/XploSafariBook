<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaRegionCulturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanzania_region_culture', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('culture_name');
            $table->longText('basic_information');
            $table->string('culture_image');
            $table->longText('traditional_language');
            $table->string('traditional_dance');
            $table->longText('traditional_dance_description');
            $table->string('traditional_food');
            $table->longText('traditional_food_description');
            $table->longText('culture_history');
            $table->longText('conclusion');
            $table->longText('cultural_video')->nullable();
            $table->unsignedBigInteger('tanzania_region_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tanzania_region_culture',function (Blueprint $table){
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
        Schema::dropIfExists('tanzania_region_culture');
    }
}
