<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageCancelledbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_tour_cancelledbookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cancellation_type');
            $table->string('cancellation_reason');
            $table->string('cancellation_reason_description');
            $table->string('accept_cancellation_policy');
            $table->unsignedBigInteger('local_tour_booking_id');
            $table->string('uuid');
            $table->string('cancellation_status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('local_tour_cancelledbookings',function(Blueprint $table){
            $table->foreign('local_tour_booking_id')->references('id')->on('local_tour_package_booking')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_tour_package_cancelledbookings');
    }
}
