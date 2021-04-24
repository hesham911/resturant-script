<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\MaterialMeasuring;

class MeasuringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaterialMeasuring::insert([
            [
                'name'=>' بالكيلو ',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'name'=>' بالوحدة ',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
