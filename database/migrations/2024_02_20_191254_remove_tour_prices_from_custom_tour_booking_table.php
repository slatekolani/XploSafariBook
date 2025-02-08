<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTourPricesFromCustomTourBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_tour_booking', function (Blueprint $table) {
            $table->dropColumn('resident_child_price');
            $table->dropColumn('resident_adult_price');
            $table->dropColumn('foreigner_adult_price');
            $table->dropColumn('foreigner_child_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_tour_booking', function (Blueprint $table) {
            $table->integer('resident_child_price');
            $table->integer('resident_adult_price');
            $table->integer('foreigner_adult_price');
            $table->integer('foreigner_child_price');
        });
    }
}
