<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsupplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_supply', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id')->unsigned();
                $table->foreign('request_id')->references('id')->on('kitchen_requests');
            $table->bigInteger('supply_id')->unsigned();
                $table->foreign('supply_id')->references('id')->on('supplies');
            $table->decimal('quantity');
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
        Schema::dropIfExists('request_supply');
    }
}
