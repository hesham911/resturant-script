<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('client_zone', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
                $table->foreign('client_id')->references('id')->on('clients');
            $table->bigInteger('zone_id')->unsigned();
                $table->foreign('zone_id')->references('id')->on('zones');
            $table->text('address');
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
        Schema::dropIfExists('client_zone');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
