<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('users')->truncate();
            DB::table('employees')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([[
            'name' => 'الكاشير',
            'email' => 'cashier@system.com',
            'password' => bcrypt("cashier"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'المحاسب',
            'email' => 'accountant@system.com',
            'password' => bcrypt("accountant"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'صالة مان',
            'email' => 'waiter@system.com',
            'password' => bcrypt("waiter"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'مدير مخازن',
            'email' => 'stockmanager@system.com',
            'password' => bcrypt("stockmanager"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'شيف',
            'email' => 'chef@system.com',
            'password' => bcrypt("chef"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'ديليفري مان',
            'email' => 'deliveryman@system.com',
            'password' => bcrypt("deliveryman"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'أدمن',
            'email' => 'admin@system.com',
            'password' => bcrypt("admin"),
            'type' => 3,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]]);
        DB::table('phones')->insert([[
            'user_id' => 1,
            'number' => '01020304050',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 2,
            'number' => '01223452345',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 3,
            'number' => '01122345234',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 4,
            'number' => '01202324245',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 5,
            'number' => '01022452342',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 6,
            'number' => '01202452357',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 7,
            'number' => '01045823942',
            'created_at' => \Carbon\Carbon::now()
        ]]);
        DB::table('employees')->insert([[
            'type' => 1,
            'user_id' => 1,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 2,
            'user_id' => 2,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 3,
            'user_id' => 3,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 4,
            'user_id' => 4,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 5,
            'user_id' => 5,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 6,
            'user_id' => 6,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]]);
    }
}