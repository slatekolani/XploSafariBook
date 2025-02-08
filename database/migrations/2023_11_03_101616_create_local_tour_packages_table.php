<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTourPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_tour_package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('safari_name');
            $table->string('trip_kind');
            $table->string('safari_description');
            $table->string('safari_poster');
            $table->decimal('maximum_travellers');
            $table->decimal('trip_price_adult_tanzanian',15,2);
            $table->decimal('trip_price_child_tanzanian',15,2);
            $table->decimal('trip_price_adult_foreigner',15,2);
            $table->decimal('trip_price_child_foreigner',15,2);
            $table->string('safari_start_date');
            $table->string('safari_end_date');
            $table->string('travel_age_range');
            $table->string('number_of_views_expecting');
            $table->string('payment_start_percent');
            $table->string('cancellation_due_date');
            $table->string('cancellation_policy');
            $table->string('payment_deadline');
            $table->string('package_range');
            $table->string('phone_number');
            $table->string('email_address');
            $table->longText('discount_offered');
            $table->longText('emergency_handling');
            $table->string('targeted_event');
            $table->string('tour_package_type_name');
            $table->string('local_tour_type');
            $table->string('transport_used_images');
            $table->unsignedBigInteger('tour_operator_id');
            $table->string('status')->default(0);
            $table->string('uuid',100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('local_tour_package',function (Blueprint $table){
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
        Schema::dropIfExists('local_tour_package');
    }
}
