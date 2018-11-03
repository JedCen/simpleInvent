<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaOperation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('q');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('restrict');
            $table->integer('operation_type_id')->unsigned()->index();
            $table->foreign('operation_type_id')->references('id')->on('operation_type')->onDelete('restrict');
            $table->integer('sell_id')->unsigned()->index()->nullable();
            $table->foreign('sell_id')->references('id')->on('sell')->onDelete('restrict');
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
        Schema::dropIfExists('operation');
    }
}
