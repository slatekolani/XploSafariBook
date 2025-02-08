<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTouristReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_tourist_review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('review_company');
            $table->longText('review_attraction');
            $table->unsignedTinyInteger('rating');
            $table->unsignedBigInteger('local_tour_booking_id');
            $table->unsignedBigInteger('local_tour_package_id');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_tourist_review',function (Blueprint $table){
            $table->foreign('local_tour_booking_id')->references('id')->on('local_tour_package_booking')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('local_tourist_review');
    }
}
