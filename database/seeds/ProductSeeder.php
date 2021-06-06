<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Product;
use App\Subcategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizza =Subcategory::where('name','البيتزات')->get()->first()->id;
        $coffee =Subcategory::where('name','القهوة')->get()->first()->id;
        Product::insert([
            [
                'name'=>'مارجريتا',
                'subcategory_id'=>$pizza,
                'price'=>'20',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'name'=>'اسبريسو',
                'subcategory_id'=> $coffee,
                'price'=>'30',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
