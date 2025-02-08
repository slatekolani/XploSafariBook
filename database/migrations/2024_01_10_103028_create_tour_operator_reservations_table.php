<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_operator_reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reservation_name');
            $table->longText('reservation_capacity');
            $table->string('reservation_url');
            $table->string('reservation_images');
            $table->string('region_found');
            $table->decimal('price_range_per_day',15,2);
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_operator_reservation',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_operator_reservation');
    }
}
