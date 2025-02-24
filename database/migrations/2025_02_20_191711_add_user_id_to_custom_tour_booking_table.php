<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCustomTourBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_tour_booking', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
        });
        
        Schema::table('custom_tour_booking',function(Blueprint $table)
        {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            //
        });
    }
}
