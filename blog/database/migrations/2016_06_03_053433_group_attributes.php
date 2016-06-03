<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type',['purpose','material','origin','color','shape','size','quality']);
            $table->integer('order');
            $table->enum('status',['hide','show']);
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
        Schema::drop('group_attributes');
    }
}
