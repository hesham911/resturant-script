<?php

namespace App\Http\Controllers;

use App\ProductManufacture;
use Illuminate\Http\Request;
use App\Http\Requests\ProductManufactureRequest;
use App\Http\Requests\ProductManufactureUpdateRequest;
use App\Product;
use App\Material;
use Illuminate\Support\Facades\Auth;


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
        $products = Product::get();
        return view('admin.productmanufactures.create',[
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
            $productmanufacture = $this->StoreNewProductManufacture($validated , $material);
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
    public function update(ProductManufactureUpdateRequest $request, ProductManufacture $productmanufacture)
    {
        $validated = $request->validated();
        $productmanufacture->update($validated);
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

    public function material_select2_ajax (Request $request){
        $product = Product::find($request->product_id);
        $search = $request->search; 
        $materials = Material::orderBy('id');
        if (isset( $product)) {
            $relatedMaterials = $product->ProductManufactures->pluck('material_id');
            $materials = $materials->notRelatedMaterials($relatedMaterials); 
            if($search != null){
                $materials = $materials->materialSearch($search,$relatedMaterials);
            }
        }
        $materials = $materials->get();
        return $materials;
    }

    private function StoreNewProductManufacture ($array , $single){
        $productmanufacture = new ProductManufacture;
        $productmanufacture->product_id = $array['product_id'];
        $productmanufacture->material_id = $single['material_id'];
        $productmanufacture->required_quantity = $single['required_quantity'];
        $productmanufacture->save();
        return  $productmanufacture ;
    }
}
