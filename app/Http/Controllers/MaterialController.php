<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;
use App\MaterialMeasuring;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::with('measuring')->get();
        return view('admin.materials.index',['materials'=>$materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermissionTo('add-material')) {
            $measurings = MaterialMeasuring::get();
            return view('admin.materials.create',['measurings'=>$measurings]);
        }else {
            abort(503);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest  $request)
    {
        if (Auth::user()->hasPermissionTo('add-material')) {
            $validated = $request->validated();
            Material::create($validated);
            $request->session()->flash('message',__('materials.massages.created_succesfully'));
            return redirect(route('materials.index'));
        }else {
            abort(503);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('admin.materials.show',['material',$material]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        if (Auth::user()->hasPermissionTo('edit-material')) {
            $measurings = MaterialMeasuring::get();
            return view('admin.materials.edit',[
                'material'=>$material,
                'measurings'=>$measurings,
            );
        }else {
            abort(503);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, Material $material)
    {
        if (Auth::user()->hasPermissionTo('edit-material')) {
            $validated = $request->validated();
            $material->update ($validated);
            $request->session()->flash('message',__('materials.massages.updated_succesfully'));
            return redirect(route('materials.index'));
        }else {
            abort(503);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request,Material $material)
    {
        if (Auth::user()->hasPermissionTo('delete-material')) {
            $material->delete();
            $request->session()->flash('message',__('materials.massages.deleted_succesfully'));
            return redirect(route('materials.index'));
            
        }else {
            abort(503);
        }
    }
}
