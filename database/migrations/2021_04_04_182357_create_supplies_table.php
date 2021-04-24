<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id')->unsigned();
                $table->foreign('material_id')->references('id')->on('materials');
            $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('measuring_id')->unsigned();
                $table->foreign('measuring_id')->references('id')->on('material_measurings');
            $table->decimal('quantity');
            $table->integer('price');
            $table->string('Supplier_name');
            $table->date('expiry_date')->nullable();
            $table->boolean('unit');
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
        Schema::dropIfExists('supplies');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
