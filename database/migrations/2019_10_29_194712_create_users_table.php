<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->string('username', 30)->nullable()->unique();
            $table->string('email', 191)->unique();
            $table->string('phone', 50)->nullable()->unique();
            $table->string('password', 191);
            $table->string('role');
            $table->string('remember_token', 100)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code', 60)->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->smallInteger('isactive')->default(1);
            $table->smallInteger('available')->default(1)->comment('set whether user is available to be seen by other portal users or not 1. Yes, 0. No ( If set 0, other users will not find this user through searching )');
            $table->string('uuid', 100)->unique();
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
        Schema::dropIfExists('users');
    }
}
