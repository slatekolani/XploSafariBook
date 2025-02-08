<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFreeOfChargeAgeChildrenToLocalTourPackageBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_tour_package_booking', function (Blueprint $table) {
            $table->string('total_free_of_charge_children')->nullable();
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
            $table->dropColumn('total_free_of_charge_children');
        });
    }
}
