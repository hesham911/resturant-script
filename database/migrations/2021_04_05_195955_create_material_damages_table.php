<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('material_damages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supply_id')->unsigned();
                $table->foreign('supply_id')->references('id')->on('supplies');
            $table->string('quantity');
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
        Schema::dropIfExists('material_damages');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
