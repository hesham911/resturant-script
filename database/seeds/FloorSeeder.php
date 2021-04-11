<?php

use Illuminate\Database\Seeder;
use App\Floor;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Floor::insert([
            [
                'name'=>'المطعم'
            ],[
                'name'=>'البار'
            ]
        ]);
    }
}
