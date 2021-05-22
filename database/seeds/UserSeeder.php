<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\User;


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
            'type' => 1,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'المحاسب',
            'email' => 'accountant@system.com',
            'password' => bcrypt("accountant"),
            'type' => 1,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'صالة مان',
            'email' => 'waiter@system.com',
            'password' => bcrypt("waiter"),
            'type' => 1,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'مدير مخازن',
            'email' => 'stockmanager@system.com',
            'password' => bcrypt("stockmanager"),
            'type' => 1,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'شيف',
            'email' => 'chef@system.com',
            'password' => bcrypt("chef"),
            'type' => 1,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'ديليفري مان',
            'email' => 'deliveryman@system.com',
            'password' => bcrypt("deliveryman"),
            'type' => 1,
            'is_admin' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'name' => 'أدمن',
            'email' => 'admin@system.com',
            'password' => bcrypt("admin"),
            'type' => 1,
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
            'number' => '01122345334',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 4,
            'number' => '01212324245',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 5,
            'number' => '01022452342',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 6,
            'number' => '01222452357',
            'created_at' => \Carbon\Carbon::now()
        ],[
            'user_id' => 7,
            'number' => '01045823942',
            'created_at' => \Carbon\Carbon::now()
        ]]);
        DB::table('employees')->insert([[
            'type' => 0,
            'user_id' => 1,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 1,
            'user_id' => 2,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 2,
            'user_id' => 3,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 3,
            'user_id' => 4,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 4,
            'user_id' => 5,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ],[
            'type' => 5,
            'user_id' => 6,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]]);
        Employee::where('type',5)->get()->first()->user->assignRole('ديليفري مان');
        Employee::where('type',4)->get()->first()->user->assignRole('الشيف');
        Employee::where('type',3)->get()->first()->user->assignRole('مدير المخزن');
        Employee::where('type',2)->get()->first()->user->assignRole('صاله مان');
        Employee::where('type',1)->get()->first()->user->assignRole('محاسب');
        Employee::where('type',0)->get()->first()->user->assignRole('كاشير');
    }
}
