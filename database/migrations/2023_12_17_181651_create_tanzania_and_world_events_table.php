<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanzaniaAndWorldEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanzania_and_world_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->longText('event_description');
            $table->string('event_date')->nullable();
            $table->string('uuid',100);
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
        Schema::dropIfExists('tanzania_and_world_event');
    }
}
