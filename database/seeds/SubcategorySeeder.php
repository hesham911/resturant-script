<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Category;
use App\Subcategory;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eats_id = Category::where('name','المأكولات')->get()->first()->id;
        $drinks_id = Category::where('name','المشروبات')->get()->first()->id;
        Subcategory::insert([
            [
                'name'=>'القهوة',
                'category_id'=>$eats_id ,
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'name'=>'البيتزات',
                'category_id'=>$drinks_id ,
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
