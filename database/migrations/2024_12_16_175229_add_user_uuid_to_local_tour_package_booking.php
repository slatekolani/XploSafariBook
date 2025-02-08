<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserUuidToLocalTourPackageBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_tour_package_booking', function (Blueprint $table) {
            $table->char('user_id',36);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('local_tour_package_booking', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('local_tour_package_booking')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }
}
