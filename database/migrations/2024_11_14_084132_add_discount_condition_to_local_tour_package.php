<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountConditionToLocalTourPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_tour_package', function (Blueprint $table) {
            $table->string('number_of_people_for_discount');
            $table->string('payment_start_percent_deadline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('local_tour_package', function (Blueprint $table) {
            //
        });
    }
}
