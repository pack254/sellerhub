<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('product_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_detail', 500 );
            $table->binary('product_image');
            $table->string('product_cost_price');
            $table->string('product_sale_price');
            $table->string('product_quantity');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('product');
    }
}
