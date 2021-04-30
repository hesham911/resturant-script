<?php

namespace App\Http\Controllers;

use App\KitchenRequest;
use App\Product;
use App\Material;
use App\WarehouseStock;
use Illuminate\Http\Request;
use App\Http\Requests\KitchenRequest as KitchenRequestRequest;

class KitchenRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kitchenrequests = KitchenRequest::with('employee','material')->get();
        return view('admin.kitchenrequests.index',['kitchenrequests'=>$kitchenrequests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::has('warehousestock')->get();
        return view('admin.kitchenrequests.create',[
            'materials'=>$materials,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KitchenRequestRequest  $request)
    {
        $validated = $request->validated();
        $WarehouseStock = WarehouseStock::where('material_id',$validated['material_id'])->get()->first();
        if ($WarehouseStock->quantity >= $validated['quantity']) {
            $WarehouseStock->quantity =$WarehouseStock->quantity - $validated['quantity'] ;
            $WarehouseStock->save();
            KitchenRequest::create($validated);
            $request->session()->flash('message',__('kitchenrequests.massages.created_succesfully'));
            return redirect(route('kitchenrequests.index'));
        }else {
            $request->session()->flash('message',' الكمية المطلوبة أكبر من المخزون ');
            return redirect(route('kitchenrequests.create'));   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KitchenRequest  $kitchenrequest
     * @return \Illuminate\Http\Response
     */
    public function show(KitchenRequestRequest $kitchenrequest)
    {
        return view('admin.kitchenrequests.show',['kitchenrequest',$kitchenrequest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KitchenRequest  $kitchenrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(KitchenRequest $kitchenrequest)
    {
        $materials = Material::get();
        return view('admin.kitchenrequests.edit',[
            'kitchenrequest'=>$kitchenrequest,
            'materials'=>$materials,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KitchenRequest  $kitchenrequest
     * @return \Illuminate\Http\Response
     */
    public function update(KitchenRequestRequest $request, KitchenRequest $kitchenrequest)
    {
        $validated = $request->validated();
        $kitchenrequest->update ($validated);
        $request->session()->flash('message',__('kitchenrequests.massages.updated_succesfully'));
        return redirect(route('kitchenrequests.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KitchenRequest  $kitchenrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request,KitchenRequest $kitchenrequest)
    {
        $kitchenrequest->delete();
        $request->session()->flash('message',__('kitchenrequests.massages.deleted_succesfully'));
        return redirect(route('kitchenrequests.index'));
    }
}
