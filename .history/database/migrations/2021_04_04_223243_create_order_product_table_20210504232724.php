<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('order_id')->unsigned();
                $table->foreign('order_id')->references('id')->on('orders');
            $table->tinyInteger('');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('order_product');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
