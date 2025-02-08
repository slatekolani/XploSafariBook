<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_tour_package_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tourist_name');
            $table->string('phone_number');
            $table->string('email_address');
            $table->decimal('total_number_foreigner_child',3);
            $table->decimal('total_number_local_child',3);
            $table->decimal('total_number_foreigner_adult',3);
            $table->decimal('total_number_local_adult',3);
            $table->string('collection_station');
            $table->string('special_attention');
            $table->string('message');
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('local_tour_package_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_tour_package_booking',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_tour_package_booking');
    }
}
