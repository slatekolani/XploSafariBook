<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nation_name');
            $table->string('nation_flag');
            $table->string('nation_description');
            $table->longText('nation_history');
            $table->string('population');
            $table->string('tourist_map');
            $table->longText('google_map');
            $table->string('status')->default(0);
            $table->string('uuid',100)->unique();
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
        Schema::dropIfExists('nation');
    }
}
