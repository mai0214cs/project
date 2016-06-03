<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('isperson',['Yes', 'No']);
            $table->string('company');
            $table->enum('gender',['Male', 'Female']);
            $table->string('fullname');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('phone');
            $table->string('address');
            $table->text('list_address');
            $table->integer('town');
            $table->integer('district');
            $table->integer('province');
            $table->enum('status',['Yes', 'No']);
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
        Schema::drop('customers');
    }
}
