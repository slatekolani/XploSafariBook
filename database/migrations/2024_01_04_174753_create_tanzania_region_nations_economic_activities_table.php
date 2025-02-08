<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaRegionNationsEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_economic_activity', function (Blueprint $table) {
            $table->unsignedBigInteger('tanzania_region_id');
            $table->unsignedBigInteger('nation_economic_activity_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('region_economic_activity',function (Blueprint $table){
            $table->foreign('tanzania_region_id')->references('id')->on('tanzania_region')->onUpdate('CASCADE');
            $table->foreign('nation_economic_activity_id')->references('id')->on('nation_economic_activities')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_economic_activity');
    }
}
