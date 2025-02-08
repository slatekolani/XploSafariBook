<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorTourInsuranceTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_insurance_type', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('tour_insurance_type_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('operator_insurance_type',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE');
            $table->foreign('tour_insurance_type_id')->references('id')->on('tour_insurance_type')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_insurance_type');
    }
}
