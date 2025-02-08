<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_operator', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->unique();
            $table->string('email_address');
            $table->string('phone_number');
            $table->string('established_date');
            $table->string('total_employees');
            $table->string('support_time_range');
            $table->string('website_url');
            $table->string('instagram_url');
            $table->string('whatsapp_url');
            $table->string('gps_url');
            $table->string('safariClass');
            $table->string('agreeCustomBooking');
            $table->string('company_nation');
            $table->string('company_logo');
            $table->string('company_team_image');
            $table->string('about_company');
            $table->string('verification_certificate');
            $table->string('tato_membership_certificate');
            $table->string('terms_and_conditions');
            $table->string('status')->default(0);
            $table->string('uuid',100)->unique();
            $table->unsignedBigInteger('users_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('tour_operator',function(Blueprint $table){
            $table->foreign('users_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_operator');
    }
}
