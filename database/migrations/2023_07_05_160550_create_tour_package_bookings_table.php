<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPackageBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_package_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tourist_name')->index();
            $table->string('tourist_email_address');
            $table->string('tourist_country')->index();
            $table->string('tourist_phone_number')->index();
            $table->integer('total_adult_travellers');
            $table->integer('total_children_travellers');
            $table->text('message');
            $table->string('status')->default(0);
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('tour_package_id');
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_package_bookings',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tour_package_id')->references('id')->on('tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_package_bookings');
    }
}
