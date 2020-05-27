<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->index();
            $table->string('type')->comment('gold, silver, oblige');
            $table->enum('sex', ['male', 'female'])->nullable()->comment('male, female');
            $table->string('karat')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->enum('boost', [0, 1])->default(0);
	        $table->double('price');
	        $table->double('sale_price')->nullable();
	        $table->string('picture');
	        $table->softDeletes();
	        $table->timestamps();

	        $table->foreign('category_id')
	              ->references('id')
	              ->on('categories')
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
        Schema::dropIfExists('products');
    }
}
