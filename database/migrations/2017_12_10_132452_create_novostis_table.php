<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovostisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novostis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namenew');
            $table->mediumText('shorttext');
            $table->longText('fultext');
            $table->boolean('published');
            $table->integer('categoris_id')->unsigned();
            $table->string('foto');
            $table->string('AddUser');
            $table->foreign('categoris_id')->references('id')->on('categoris');
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
        Schema::dropIfExists('novostis');
    }
}
