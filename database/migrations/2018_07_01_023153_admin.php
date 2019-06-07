<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin',function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name','35');
            $table->string('password','32');
            $table->string('avatar','125')->default('');
            $table->string('ip','45')->default('');
            $table->tinyInteger('use')->default('1');
            $table->timestamps();
            $table->softDeletes();
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
