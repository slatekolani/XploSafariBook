<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTourPricesToTourOperatorReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_operator_reservation', function (Blueprint $table) {
            $table->decimal('resident_child_price_reservation',15,2)->nullable();
            $table->decimal('resident_adult_price_reservation',15,2)->nullable();
            $table->decimal('foreigner_adult_price_reservation',15,2)->nullable();
            $table->decimal('foreigner_child_price_reservation',15,2)->nullable();
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
            $table->dropColumn('resident_child_price_reservation');
            $table->dropColumn('resident_adult_price_reservation');
            $table->dropColumn('foreigner_adult_price_reservation');
            $table->dropColumn('foreigner_child_price_reservation');
        });
    }
}
