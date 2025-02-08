<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTourBookingTourPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_tour_booking_tour_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attraction_id');
            $table->decimal('resident_adult_price',15,2)->nullable();
            $table->decimal('resident_child_price',15,2)->nullable();
            $table->decimal('foreigner_child_price',15,2)->nullable();
            $table->decimal('foreigner_adult_price',15,2)->nullable();
            $table->unsignedBigInteger('custom_tour_booking_id');
            $table->string('uuid',100);
            $table->timestamps();
        });
        Schema::table('custom_tour_booking_tour_prices',function (Blueprint $table){
            $table->foreign('custom_tour_booking_id')->references('id')->on('custom_tour_booking')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_tour_booking_tour_prices');
    }
}
