<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicAttractionRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_attraction_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rule_title');
            $table->string('rule_description');
            $table->unsignedBigInteger('nation_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('touristic_attraction_rules',function (Blueprint $table){
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
        Schema::dropIfExists('touristic_attraction_rules');
    }
}
