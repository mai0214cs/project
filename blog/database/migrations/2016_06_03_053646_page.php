<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Page extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->longText('detail');
            $table->integer('id_category');
            $table->string('avatar');
            $table->string('SEO_title');
            $table->string('SEO_description');
            $table->string('SEO_keyword');
            $table->enum('status',['Yes','No']);
            $table->integer('orderby');
            $table->text('related');
            $table->enum('type',['home','news_category','news_list','product_category','product_list']);
            $table->string('alias');
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
