<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tourist_name')->index();
            $table->text('review_title')->index();
            $table->text('review_message');
            $table->string('uuid',100);
            $table->string('status')->default(0);
            $table->unsignedBigInteger('tour_package_booking_id');
            $table->unsignedBigInteger('tour_operator_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tourist_reviews',function (Blueprint $table){
            $table->foreign('tour_package_booking_id')->references('id')->on('tour_package_bookings')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('tourist_reviews');
    }
}
