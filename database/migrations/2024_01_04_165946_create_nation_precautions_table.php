<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationPrecautionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nation_precautions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('precaution_title');
            $table->longText('precaution_description');
            $table->unsignedBigInteger('nation_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('nation_precautions',function (Blueprint $table){
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
        Schema::dropIfExists('nation_precautions');
    }
}
