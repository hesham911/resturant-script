<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Schema::create('work_periods', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');
                $table->bigInteger('bank_id')->unsigned();
                    $table->foreign('bank_id')->references('id')->on('banks');
                $table->decimal('opening_balance')->default(0);
                $table->decimal('close_balance');
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
            Schema::dropIfExists('work_periods');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
