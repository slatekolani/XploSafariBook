<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFreeOfChargeAgeToLocalTourPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_tour_package', function (Blueprint $table) {
            $table->string('free_of_charge_age')->nullable();
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
            $table->dropColumn('free_of_charge_age');
        });
    }
}
