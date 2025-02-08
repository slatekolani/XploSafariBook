<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('main_safari_name')->index();
            $table->string('safari_package_description');
            $table->string('safari_poster');
            $table->decimal('trip_price_adult_tanzanian',15,2);
            $table->decimal('trip_price_child_tanzanian',15,2);
            $table->decimal('trip_price_adult_foreigner',15,2);
            $table->decimal('trip_price_child_foreigner',15,2);
            $table->string('safari_start_date');
            $table->string('safari_end_date');
            $table->unsignedBigInteger('tour_operator_id');
            $table->unsignedBigInteger('users_id');
            $table->string('status')->default(0);
            $table->string('uuid',100)->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_package',function (Blueprint $table){
            $table->foreign('tour_operator_id')->references('id')->on('tour_operator')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_package');
    }
}
