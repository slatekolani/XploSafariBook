<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPackageAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_package_accommodations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day_number');
            $table->string('accommodation_name');
            $table->string('accommodation_description');
            $table->string('accommodation_link');
            $table->unsignedBigInteger('tour_package_id');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('uuid',100)->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_package_accommodations',function (Blueprint $table) {
            $table->foreign('tour_package_id')->references('id')->on('tour_package')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('tour_package_accommodations');
    }
}
