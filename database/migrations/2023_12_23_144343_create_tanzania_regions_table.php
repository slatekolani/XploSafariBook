<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanzania_region', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('region_name');
            $table->string('region_icon_image');
            $table->string('economic_activity');
            $table->longText('region_size');
            $table->longText('population');
            $table->longText('climatic_condition');
            $table->longText('transport_nature');
            $table->longText('region_description');
            $table->longText('region_history');
            $table->longText('region_map');
            $table->unsignedBigInteger('nation_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tanzania_region',function (Blueprint $table){
            $table->foreign('nation_id')->references('id')->on('nation')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanzania_region');
    }
}
