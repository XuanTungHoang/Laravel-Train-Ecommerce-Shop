<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('token');
            $table->timestamps();
        });

        Schema::table('users',function(Blueprint $table){
            $table->boolean('is_activated')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activations');
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('is_activated');
        });
    }
}
