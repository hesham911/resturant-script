<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Schema::create('materials', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->bigInteger('measuring_id')->unsigned();
                    $table->foreign('measuring_id')->references('id')->on('material_measurings');
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
            Schema::dropIfExists('materials');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
