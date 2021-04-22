<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Schema::create('phones', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');
                $table->integer('number');
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
            Schema::dropIfExists('phones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
