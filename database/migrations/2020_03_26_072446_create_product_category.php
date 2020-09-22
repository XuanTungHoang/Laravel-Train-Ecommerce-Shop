<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pros_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('products');
            $table->integer('cate_id')->unsigned();
            $table->foreign('cate_id')->references('id')->on('category_child');
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
        Schema::dropIfExists('pros_cats');
    }
}
