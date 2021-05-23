<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Material;
use App\MaterialMeasuring;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kilo = MaterialMeasuring::where('name','بالكيلو')->get()->first();
        $unit = MaterialMeasuring::where('name','بالوحدة')->get()->first();
        Material::insert([
            [
                'name'=>' طماطم',
                'measuring_id'=> $kilo->id,
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'name'=>'فراخ',
                'measuring_id'=> $unit->id,
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
