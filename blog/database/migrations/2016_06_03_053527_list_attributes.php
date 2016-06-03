<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_group');
            $table->string('name');
            $table->integer('order');
            $table->enum('status',['hide','show']);
            $table->double('plus_price',15,8);
            $table->enum('type_plus_price',['percent','quantity']);
            $table->string('config');
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
        Schema::drop('list_attributes');
    }
}
