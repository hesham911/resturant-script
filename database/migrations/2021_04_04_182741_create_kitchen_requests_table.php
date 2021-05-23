<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitchenRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('kitchen_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id')->unsigned();
                $table->foreign('material_id')->references('id')->on('materials');
            $table->decimal('quantity');
            $table->decimal('used_amount')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('total_cost');
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
        Schema::dropIfExists('kitchen_requests');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
