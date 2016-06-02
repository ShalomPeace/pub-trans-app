<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('train_id')->unsigned()->index();
            $table->integer('departure_station_id')->unsigned()->index();
            $table->integer('arrival_station_id')->unsigned()->index();
            $table->date('departure_date');
            $table->time('departure_time');
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->integer('operator_id')->unsigned()->index();
            $table->timestamps();
            $table->integer('user_id')->unsigned()->index();

            $table->foreign('train_id')->references('id')->on('trains');
            $table->foreign('departure_station_id')->references('id')->on('stations');
            $table->foreign('arrival_station_id')->references('id')->on('stations');
            $table->foreign('operator_id')->references('id')->on('operators');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}
