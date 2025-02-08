<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePriceRangePerDayColumnFromTourOperatorReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_operator_reservation', function (Blueprint $table) {
            $table->dropColumn('price_range_per_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_operator_reservation', function (Blueprint $table) {
            $table->integer('price_range_per_day');
        });
    }
}
