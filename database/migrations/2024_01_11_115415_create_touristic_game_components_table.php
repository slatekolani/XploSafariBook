<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicGameComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_game_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('game_component');
            $table->string('component_description');
            $table->unsignedBigInteger('touristic_game_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('touristic_game_components',function (Blueprint $table){
            $table->foreign('touristic_game_id')->references('id')->on('touristic_game')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touristic_game_components');
    }
}
