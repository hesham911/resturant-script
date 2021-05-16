<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned()->nullable();
                $table->foreign('client_id')->references('id')->on('clients');
            $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('categories');
            $table->bigInteger('table_id')->unsigned()->nullable();
                $table->foreign('table_id')->references('id')->on('tables');
                
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->text('cancel_reason')->nullable();
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
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
