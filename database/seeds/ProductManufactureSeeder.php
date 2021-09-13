<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductManufacture;
use App\Material;
use Carbon\Carbon;


class ProductManufactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $margrita =Product::where('name','مارجريتا')->get()->first()->id;
        $spresso =Product::where('name','اسبريسو')->get()->first()->id;
        $tomato = Material::where('name','طماطم')->get()->first()->id;
        $checken = Material::where('name','فراخ')->get()->first()->id;
        $cofee = Material::where('name','قهوة')->get()->first()->id;
        ProductManufacture::insert([
            [
                'material_id'=>$tomato,
                'product_id'=>$margrita,
                'required_quantity'=>'20',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'material_id' =>$checken,
                'product_id'=>$margrita,
                'required_quantity'=>'20',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
            ,[
                'material_id' =>$cofee,
                'product_id'=>$spresso,
                'required_quantity'=>'0.25',
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=> Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
