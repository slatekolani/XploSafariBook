<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristicAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touristic_attraction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attraction_name')->index();
            $table->longText('attraction_description');
            $table->string('attraction_category');
            $table->string('establishment_year');
            $table->longText('seasonal_variation');
            $table->longText('flora_fauna');
            $table->string('attraction_region');
            $table->string('governing_body');
            $table->string('website_link');
            $table->string('attraction_visit_month');
            $table->longText('basic_information');
            $table->string('attraction_map')->nullable();
            $table->string('attraction_image');
            $table->decimal('entry_fee_adult_foreigner',12,2);
            $table->decimal('entry_fee_child_foreigner',12,2);
            $table->decimal('entry_fee_child_local',12,2);
            $table->decimal('entry_fee_adult_local',12,2);
            $table->longText('personal_experience');
            $table->string('uuid',100)->unique();
            $table->string('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touristic_attraction');
    }
}
