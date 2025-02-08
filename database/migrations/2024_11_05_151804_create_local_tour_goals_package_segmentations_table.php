<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourGoalsPackageSegmentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_tour_goals_package_segmentations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_type');
            $table->string('total_tours');
            $table->string('total_travellers');
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('goal_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_tour_goals_package_segmentations', function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('goal_id')->references('id')->on('tour_company_local_tours_goals')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_tour_goals_package_segmentations');
    }
}
