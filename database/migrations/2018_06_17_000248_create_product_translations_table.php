<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->index();
	        $table->string('locale')->index();
	        $table->string('name')->default('')->nullable();
	        $table->text('short_description')->nullable();
	        $table->text('description')->nullable();

	        $table->unique(['product_id','locale']);
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
        Schema::dropIfExists('product_translations');
    }
}
