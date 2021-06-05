<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Schema::create('bank_transactions', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users');
                $table->bigInteger('bank_id')->unsigned();
                    $table->foreign('bank_id')->references('id')->on('banks');
                $table->text('notes')->nullable();
                $table->decimal('amount');
                $table->decimal('balance');
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
            Schema::dropIfExists('bank_transactions');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
