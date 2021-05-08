<?php

namespace App\Http\Controllers;

use App\ProductManufacture;
use Illuminate\Http\Request;
use App\Http\Requests\ProductManufactureRequest;
use App\Product;
use App\Material;

class ProductManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_manufactures = ProductManufacture::get();
        return view('admin.productmanufactures.index',['product_manufactures'=>$product_manufactures]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::get();
        $products = Product::get();
        return view('admin.productmanufactures.create',[
            'materials'=>$materials,
            'products'=>$products,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductManufactureRequest  $request)
    {
        $validated = $request->validated();
        foreach ($validated['group'] as $material) {
            $productmanufacture = new ProductManufacture;
            $productmanufacture->product_id = $validated['product_id'];
            $productmanufacture->material_id = $material['material_id'];
            $productmanufacture->required_quantity = $material['required_quantity'];
            $productmanufacture->waste_percentage = $material['waste_percentage'];
            $productmanufacture->save();
        }
        $request->session()->flash('message',__('productmanufactures.massages.created_succesfully'));
        return redirect(route('productmanufactures.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductManufacture  $productmanufacture
     * @return \Illuminate\Http\Response
     */
    public function show(ProductManufacture $product_manufacture)
    {
        return view('admin.productmanufactures.show',['product_manufacture',$product_manufacture]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductManufacture  $productmanufacture
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductManufacture $productmanufacture)
    {
        $materials = Material::get();
        $products = Product::get();  
        return view('admin.productmanufactures.edit',[
            'productmanufacture'=>$productmanufacture,
            'materials'=>$materials,
            'products'=>$products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductManufacture  $productmanufacture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductManufacture $productmanufacture)
    {
        $validated = $request->validate([
            'material_id'=>'required',
            'product_id'=>'required',
            'required_quantity'=>'required',
            'waste_percentage'=>'required',
        ],[
            'material_id'=>__('productmanufactures.material_id'),
            'product_id'=>__('productmanufactures.product_id'),
            'required_quantity'=>__('productmanufactures.required_quantity'),
            'waste_percentage'=>__('productmanufactures.waste_percentage'),
        ]);
        $productmanufacture->product_id = $validated['product_id'];
        $productmanufacture->material_id = $validated['material_id'];
        $productmanufacture->required_quantity = $validated['required_quantity'];
        $productmanufacture->waste_percentage = $validated['waste_percentage'];
        $productmanufacture->save();
        $request->session()->flash('message',__('productmanufactures.massages.updated_succesfully'));
        return redirect(route('productmanufactures.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductManufacture  $productmanufacture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,ProductManufacture $productmanufacture)
    {
        $productmanufacture->delete();
        $request->session()->flash('message',__('productmanufactures.massages.deleted_succesfully'));
        return redirect(route('productmanufactures.index'));
    }
}
