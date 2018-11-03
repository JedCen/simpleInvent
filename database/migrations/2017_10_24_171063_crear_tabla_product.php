<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('image', 255)->nullable();
            $table->string('barcode', 50)->nullable();
            $table->string('name', 50)->unique()->nullable();
            $table->text('description')->nullable();
            $table->integer('inventary_min')->default(10);
            $table->float('price_in')->nullable();
            $table->float('price_out')->nullable();
            $table->string('unit', 255)->nullable();
            $table->string('presentation', 255)->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('restrict');
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('product');
    }
}
