<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaRegionCultureCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culture_characteristics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('characteristic_title');
            $table->longText('characteristic_description');
            $table->unsignedBigInteger('tanzania_region_culture_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('culture_characteristics',function (Blueprint $table){
            $table->foreign('tanzania_region_culture_id')->references('id')->on('tanzania_region_culture')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('culture_characteristics');
    }
}
