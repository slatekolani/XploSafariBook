<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaFAQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanzania_faq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question_title');
            $table->string('question_answer');
            $table->unsignedBigInteger('nation_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tanzania_faq',function (Blueprint $table){
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
        Schema::dropIfExists('tanzania_faq');
    }
}
