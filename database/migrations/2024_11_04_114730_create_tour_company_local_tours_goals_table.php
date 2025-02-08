<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourCompanyLocalToursGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_company_local_tours_goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('goal_description');
            $table->string('year');
            $table->string('number_of_tours_to_be_made');
            $table->string('number_of_travellers');
            $table->string('number_of_mail_subscribers');
            $table->string('number_of_tour_reviewers');
            $table->string('projected_revenue');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_company_local_tours_goals', function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_company_local_tours_goals');
    }
}
