<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'name'=>'المأكولات',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'name'=>'المشروبات',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
