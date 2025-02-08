<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristAttractionFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_attraction_faq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question_title');
            $table->longText('question_description');
            $table->unsignedBigInteger('touristic_attraction_id');
            $table->string('uuid',100);
            $table->string('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tourist_attraction_faq', function (Blueprint $table){
            $table->foreign('touristic_attraction_id')->references('id')->on('touristic_attraction')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tourist_attraction_faq');
    }
}
