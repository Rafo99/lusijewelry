<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
	        $table->increments('id');
	        $table->unsignedInteger('order_id')->index();
	        $table->unsignedInteger('product_id')->index();
	        $table->unsignedInteger('qty');
	        $table->double('price');

	        $table->foreign('order_id')
	              ->references('id')
	              ->on('orders')
	              ->onDelete('cascade');

	        $table->foreign('product_id')
	              ->references('id')
	              ->on('products')
	              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
