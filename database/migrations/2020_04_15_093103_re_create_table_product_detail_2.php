<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReCreateTableProductDetail2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->foreign('pro_id')->references('id')->on('products');
            $table->string('size_S');
            $table->string('size_M');
            $table->string('size_L');
            $table->string('size_XS');
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
        Schema::dropIfExists('product_detail');
    }
}
