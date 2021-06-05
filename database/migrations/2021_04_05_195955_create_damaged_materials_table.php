<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('damaged_materials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id')->unsigned();
                $table->foreign('material_id')->references('id')->on('materials');
            $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
            $table->string('quantity');
            $table->decimal('price');
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
        Schema::dropIfExists('damaged_materials');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
