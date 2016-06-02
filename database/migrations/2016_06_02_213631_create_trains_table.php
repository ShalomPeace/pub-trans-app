<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trains', function(Blueprint $table) 
        {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name', 20);
            $table->tinyInteger('total_seats')->unsigned();
            $table->boolean('active')->unsigned();
            $table->timestamps();
            $table->integer('user_id')->unsigned()->index();

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
        Schema::drop('trains');
    }
}
