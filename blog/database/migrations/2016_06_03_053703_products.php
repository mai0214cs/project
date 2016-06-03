<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_import');
            $table->integer('price_sale');
            $table->integer('price_promotion');
            $table->enum('included_VAT',['Yes','No']);
            $table->integer('quantity');
            $table->enum('manager_inventory',['Yes','No']);
            $table->integer('id_page');
            $table->enum('new',['Yes','No']);
            $table->enum('seller',['Yes','No']);
            $table->enum('promotion',['Yes','No']);
            $table->enum('featured',['Yes','No']);
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
        //
    }
}
