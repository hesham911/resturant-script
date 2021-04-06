<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('used_materials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id')->unsigned();
                $table->foreign('request_id')->references('id')->on('kitchen_requests');
            $table->bigInteger('supply_id')->unsigned();
                $table->foreign('supply_id')->references('id')->on('supplies');
            $table->decimal('total_cost');
            $table->timestamps();
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
        Schema::dropIfExists('used_materials');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
