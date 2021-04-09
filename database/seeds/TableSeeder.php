<?php

use Illuminate\Database\Seeder;
use App\Table;
use App\Floor;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $resturant = Floor::where('name','المطعم')->get()->first()->id;
       $bar = Floor::where('name','البار')->get()->first()->id;
       Table::insert([
           [
               'name'=>'طاولة 1',
                'floor_id'=>$resturant
           ],
           [
            'name'=>'طاولة 2',
             'floor_id'=>$bar
           ]
       ]);
    }
}
