<?php

use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('zones')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('zones')->insert([
            [
                'name'  => 'منطقة 1',
                'price' => 10,
            ],
            [
                'name'  => 'منطقة 2',
                'price' => 15,
            ],

        ]);
    }
}
