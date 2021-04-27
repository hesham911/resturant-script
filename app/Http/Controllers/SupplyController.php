<?php

namespace App\Http\Controllers;

use App\Supply;
use App\Material;
use App\Employee;
use App\MaterialMeasuring;
use App\WarehouseStock;
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
        $supplies = Supply::with('employee','material','material.measuring')->get();
        return view('admin.supplies.index',['supplies'=>$supplies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::with('measuring')->get();
        return view('admin.supplies.create',[
            'materials' => $materials,
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
        // dd($validated['material_id']);
        $supply = new Supply;
        $supply->material_id =  $validated['material_id'];
        $supply->quantity =  $validated['quantity'];
        $supply->price =  $validated['price'];
        $supply->Supplier_name =  $validated['Supplier_name'];
        $supply->expiry_date =  $validated['expiry_date'];
        $employee = Employee::where('user_id',$request->user_id)->get()->first();
        $supply->employee_id =  $employee->id;
        $supply->save();
        $stock = WarehouseStock::firstOrNew(['material_id'=>$validated['material_id']]);
        $stock->material_id = $validated['material_id'];
        $stock->quantity = $stock->quantity + $validated['quantity'];
        $stock->save();
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
        $materials = Material::get();
        return view('admin.supplies.edit',[
            'supply'=>$supply,
            'materials'=>$materials,
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
        //to reset the last added quantity
        $warehouse_stock = WarehouseStock::findOrFail($supply->material_id);
        $warehouse_stock->quantity = $warehouse_stock->quantity - $supply->quantity ;
        $warehouse_stock->save();
        $supply->material_id =  $validated['material_id'];
        $supply->quantity =  $validated['quantity'];
        $supply->price =  $validated['price'];
        $supply->Supplier_name =  $validated['Supplier_name'];
        $supply->expiry_date =  $validated['expiry_date'];
        $supply->employee_id =  $request->employee_id;
        $supply->save();
        $warehouse_stock = WarehouseStock::findOrFail($validated['material_id']);
        $warehouse_stock->quantity = $warehouse_stock->quantity + $supply->quantity ;
        $warehouse_stock->save();
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
