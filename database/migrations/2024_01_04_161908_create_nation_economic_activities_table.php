<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nation_economic_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('economic_activity_title');
            $table->longText('economic_activity_description');
            $table->unsignedBigInteger('nation_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('nation_economic_activities',function (Blueprint $table){
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
        Schema::dropIfExists('nation_economic_activities');
    }
}
