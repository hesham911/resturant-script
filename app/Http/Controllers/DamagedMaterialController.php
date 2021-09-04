<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DamagedMaterial;
use App\Material;
use App\Supply;
use App\Http\Requests\DamagedMaterialRequest;

class DamagedMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $damaged_materials = DamagedMaterial::with('material')->get();
        return view('admin.damagedmaterials.index',[
            'damaged_materials' => $damaged_materials ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::get();
        return view('admin.damagedmaterials.create',[
            'materials' => $materials ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , DamagedMaterialRequest $form_request)
    {
        $validated_data = $form_request->validated();
        foreach ($validated_data['group'] as $item ) {
            $calculation = Supply::calculation($item['material_id'] , $item['quantity']  );
            $damaged_material = new DamagedMaterial;
            $damaged_material->user_id = $validated_data['user_id'];
            $damaged_material->material_id = $item['material_id'];
            $damaged_material->quantity = $item['quantity'];
            $damaged_material->price = $calculation['request_total_price'];
            $damaged_material->save();
        }
        $request->session()->flash('message',__('damagedmaterials.massages.created_succesfully'));
        return redirect(route('damagedmaterials.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DamagedMaterial $damagermaterial)
    {
        $materials = Material::get();
        return view('admin.damagedmaterials.create',[
            'materials' => $materials ,
            'damagermaterial' => $damagermaterial ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
