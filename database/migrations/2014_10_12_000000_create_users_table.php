<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique()->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->tinyInteger('type')->default('0');
                $table->tinyInteger('is_admin')->default('0');
                $table->rememberToken();
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
            Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
