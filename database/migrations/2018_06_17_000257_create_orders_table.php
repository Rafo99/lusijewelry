<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('product_id');
	        $table->string('name');
	        $table->string('last_name')->nullable();
	        $table->string('email_phone');
	        $table->string('address');
	        $table->text('message')->nullable();
	        $table->boolean('sent')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
