<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Schema::create('banks', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('opening_balance')->default(0);
                $table->text('notes')->nullable();
                $table->string('type');
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
            Schema::dropIfExists('banks');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
