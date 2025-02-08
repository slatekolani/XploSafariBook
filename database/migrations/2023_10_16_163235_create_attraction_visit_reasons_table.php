<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionVisitReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attraction_visit_reasons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reason_number');
            $table->string('reason_title');
            $table->longText('reason_description');
            $table->unsignedBigInteger('touristic_attraction_id');
            $table->string('uuid',100)->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('attraction_visit_reasons',function (Blueprint $table){
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
        Schema::dropIfExists('attraction_visit_reasons');
    }
}
