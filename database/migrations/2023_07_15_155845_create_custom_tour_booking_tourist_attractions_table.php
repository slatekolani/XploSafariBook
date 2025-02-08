<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTourBookingTouristAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_booking_attraction', function (Blueprint $table) {
            $table->unsignedBigInteger('custom_tour_booking_id');
            $table->unsignedBigInteger('tourist_attraction_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('custom_booking_attraction',function (Blueprint $table){
            $table->foreign('custom_tour_booking_id')->references('id')->on('custom_tour_booking')->onUpdate('CASCADE');
            $table->foreign('tourist_attraction_id')->references('id')->on('touristic_attraction')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_booking_attraction');
    }
}
