<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_request', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id')->unsigned();
                $table->foreign('request_id')->references('id')->on('kitchen_requests');
            $table->bigInteger('order_id')->unsigned();
                $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('order_request');
    }
}
