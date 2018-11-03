<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSell extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('person_id')->unsigned()->index();
            $table->foreign('person_id')->references('id')->on('person')->onDelete('restrict');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('operation_type_id')->unsigned()->index();
            $table->foreign('operation_type_id')->references('id')->on('operation_type')->onDelete('restrict');
            $table->integer('box_id')->unsigned()->index()->nullable();
            $table->foreign('box_id')->references('id')->on('box')->onDelete('restrict');
            $table->double('total')->nullable();
            $table->double('cash')->nullable();
            $table->double('discount')->default(0);
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
        Schema::dropIfExists('sell');
    }
}
