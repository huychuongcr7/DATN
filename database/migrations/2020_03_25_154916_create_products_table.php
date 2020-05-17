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
            $table->string('product_code', 10)->unique();
            $table->string('qr_code', 64)->nullable();
            $table->string('name', 64)->unique();
            $table->string('image_url')->default('/images/products/product1.jpg');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedInteger('trademark_id')->nullable();
            $table->foreign('trademark_id')->references('id')->on('trademarks')->onDelete('cascade');
            $table->integer('sale_price');
            $table->integer('entry_price');
            $table->integer('inventory');
            $table->string('location', 64)->nullable();
            $table->integer('inventory_level_min')->nullable();
            $table->integer('inventory_level_max')->nullable();
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('type');
            $table->string('description')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('products');
    }
}
