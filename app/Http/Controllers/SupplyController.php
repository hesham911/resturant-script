<?php

namespace App\Http\Controllers;

use App\Supply;
use App\Material;
use App\MaterialMeasuring;
use Illuminate\Http\Request;
use App\Http\Requests\SupplyRequest;


class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = Supply::with('measurings')->get();
        return view('admin.supplies.index',['supplies'=>$supplies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::get();
        $measurings = MaterialMeasuring::get();
        return view('admin.supplies.create',[
            'materials' => $materials,
            'measurings' => $measurings,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplyRequest  $request)
    {
        $validated = $request->validated();
        Supply::create($validated);
        $request->session()->flash('message',__('supplies.massages.created_succesfully'));
        return redirect(route('supplies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubSupply  $supply
     * @return \Illuminate\Http\Response
     */
    public function show(Supply $supply)
    {
        return view('admin.supplies.show',['supply' => $supply]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubSupply  $supply
     * @return \Illuminate\Http\Response
     */
    public function edit(Supply $supply)
    {
        return view('admin.supplies.edit',[
            'supply'=>$supply,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubSupply  $supply
     * @return \Illuminate\Http\Response
     */
    public function update(SupplyRequest $request,Supply $supply)
    {
        $validated = $request->validated();
        $supply->update ($validated);
        $request->session()->flash('message',__('supplies.massages.updated_succesfully'));
        return redirect(route('supplies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubSupply  $supply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Supply $supply)
    {
        $supply->delete();
        $request->session()->flash('message',__('supplies.massages.deleted_succesfully'));
        return redirect(route('supplies.index'));
    }
}
