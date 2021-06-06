<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('floor_id')->unsigned();
                $table->foreign('floor_id')->references('id')->on('floors');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('tables');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
