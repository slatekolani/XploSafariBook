<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackageCustomerSatisfactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_customer_satisfaction', function (Blueprint $table) {
            $table->unsignedBigInteger('local_tour_package_id');
            $table->unsignedBigInteger('customer_satisfaction_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('package_customer_satisfaction',function (Blueprint $table){
            $table->foreign('local_tour_package_id')->references('id')->on('local_tour_package')->onUpdate('CASCADE');
            $table->foreign('customer_satisfaction_id')->references('id')->on('customer_satisfaction_category')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_customer_satisfaction');
    }
}
