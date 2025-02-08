<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaVisitAdviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanzania_visit_advice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('advice_title');
            $table->longText('advice_description');
            $table->string('directory_url');
            $table->unsignedBigInteger('nation_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('tanzania_visit_advice',function (Blueprint $table){
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
        Schema::dropIfExists('tanzania_visit_advice');
    }
}
