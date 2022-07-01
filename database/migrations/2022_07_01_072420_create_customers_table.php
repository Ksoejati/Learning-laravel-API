<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
    user_login_id int
  first_name varchar
  last_name varchar
  post_code_id int
  address varchar
  telephone numeric
  customer_type enum //['Residential','VIP']
  customer_status enum //['Active', 'Pending', 'Blacklist']
  created_at datetime
  updated_at datetime
    */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_code_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('customer_type', ['Residential','VIP']);
            $table->enum('customer_status', ['Active', 'Pending', 'Blacklist']);
            $table->string('address');
            $table->integer('mobile_phone');
            $table->timestamps();

            $table->foreign('post_code_id')->references('id')->on('post_codes')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');

        Schema::dropForeign('posts_user_id_foreign');
    }
}
