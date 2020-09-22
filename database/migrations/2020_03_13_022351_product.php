<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->string('gender');
            $table->string('image');
            $table->string('category');
            $table->string('status');
            $table->timestamps();
        });
        
        // Schema::table('products', function($table) {
        //     $table->foreign('cate_id')->references('id')->on('category_child');
           
        // });
        // Schema::table('products',function(Blueprint $table){
        //     $table->dropForeign('cate_id');
        //     $table->dropColumn('cate_id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        //  Schema::table('products',function(Blueprint $table){
        //     $table->dropForeign('products_cate_id_foreign');
        //     $table->dropColumn('cate_id');
        // });

       

        Schema::dropIfExists('products');
    }
}
