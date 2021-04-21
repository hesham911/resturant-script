<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::insert([
            [
                'name'=>' طماطم',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'name'=>'فراخ',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
