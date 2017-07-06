<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('company')->nullable();
            $table->string('image_url');
            $table->unsignedInteger('user_id');
            $table->date('birthday');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
