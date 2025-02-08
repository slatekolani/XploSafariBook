<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_game', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('game_name');
            $table->string('game_category');
            $table->longText('game_theme');
            $table->string('total_players');
            $table->string('age');
            $table->string('tutorial_directory_link');
            $table->string('game_images');
            $table->string('game_price');
            $table->longText('mode_of_play');
            $table->longText('development_inspiration');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touristic_game');
    }
}
