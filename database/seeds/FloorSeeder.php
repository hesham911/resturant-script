<?php

use Illuminate\Database\Seeder;
use App\Floor;
use Carbon\Carbon;


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
                'name'=>'المطعم',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ],[
                'name'=>'البار',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
