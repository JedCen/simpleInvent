<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('image', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('company', 50)->nullable();
            $table->string('rfc', 14)->nullable();
            $table->string('address1', 50)->nullable();
            $table->string('address2', 50)->nullable();
            $table->string('phone1', 50)->nullable();
            $table->string('phone2', 50)->nullable();
            $table->string('email1', 50)->nullable();
            $table->string('email2', 50)->nullable();
            $table->string('slug')->unique();
            $table->integer('kind');
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
        Schema::dropIfExists('person');
    }
}
