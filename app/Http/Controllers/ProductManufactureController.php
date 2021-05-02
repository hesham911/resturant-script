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
        ProductManufacture::create($validated);
        $request->session()->flash('message',__('productmanufactures.massages.created_succesfully'));
        return redirect(route('productmanufactures.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductManufacture  $productmanufacture
     * @return \Illuminate\Http\Response
     */
    public function show(ProductManufacture $productmanufacture)
    {
        return view('admin.productmanufactures.show',['category',$productmanufacture]);
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
    public function update(ProductManufactureRequest $request, ProductManufacture $productmanufacture)
    {
        $validated = $request->validated();
        $productmanufacture->update ($validated);
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
