<?php

namespace App\Http\Controllers;

use App\KitchenRequest;
use App\Product;
use App\Material;
use App\WarehouseStock;
use Illuminate\Http\Request;
use App\Http\Requests\KitchenRequest as KitchenRequestRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        $materials = Material::whereHas('warehousestock',function($query){
            $query->where('quantity','>', 0);
        })->get();
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
        $validated_data = $request->validated();
        foreach ($validated_data['group'] as  $kitchen_request) {
            $material = Material::find($kitchen_request['material_id']);
            $supplies = $material->supplies->where('status',false);
            $request_quantity = $kitchen_request['quantity'];
            $WarehouseStock = WarehouseStock::where('material_id',$kitchen_request['material_id'])->get()->first();
            $request_total_price=0 ;
            $supply_ids = [];
            if ($WarehouseStock->quantity >= $kitchen_request['quantity']) {
                foreach ($supplies as $supply) {
                    $supply_remaining_amount = $supply->quantity - $supply->used_amount;
                    $supply_unit_price = $supply->price / $supply->quantity;
                    if ( $request_quantity  > 0) {
                        if ($supply_remaining_amount < $request_quantity) {
                            $request_quantity =  $request_quantity - $supply_remaining_amount;
                            $supply->used_amount = $supply->quantity;
                            $supply->status = true;
                            $request_total_price = $request_total_price + ( $supply_unit_price * $supply_remaining_amount);
                            $supply->save();
                        }elseif ( $supply_remaining_amount > $request_quantity ) {
                            $supply->used_amount = $supply->used_amount + $request_quantity;
                            $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                            $request_quantity = 0;
                            $supply->save();
                        }else {
                            $supply->used_amount = $supply->used_amount + $request_quantity;
                            $supply->status = true;
                            $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                            $request_quantity = 0;
                            $supply->save();
                        }
                        $supply_ids[]= $supply->id;
                    }
                }
                $WarehouseStock->quantity =$WarehouseStock->quantity - $kitchen_request['quantity'] ;
                $WarehouseStock->save();
                $kitchenrequest = new KitchenRequest;
                $kitchenrequest->material_id = $kitchen_request['material_id'];
                $kitchenrequest->quantity = $kitchen_request['quantity'];
                $kitchenrequest->employee_id = $request->employee_id;
                $kitchenrequest->total_cost = $request_total_price;
                $kitchenrequest->save();
                $kitchenrequest->supplies()->sync($supply_ids);
            }else {
                $request->session()->flash('message',' الكمية المطلوبة أكبر من المخزون ');
                return redirect(route('kitchenrequests.create'));   
            }
        }
        $request->session()->flash('message',__('kitchenrequests.massages.created_succesfully'));
        return redirect(route('kitchenrequests.index'));
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
        $oldWarehouseStock = WarehouseStock::where('material_id', $kitchenrequest->material_id)->get()->first();
        foreach ($kitchenrequest->supplies as  $supply) {
            if ( $kitchenrequest->quantity  != 0) {
                if ($supply->used_amount <= $kitchenrequest->quantity ) {
                    $supply->used_amount = 0;
                }else{
                    $supply->used_amount = $supply->used_amount - $kitchenrequest->quantity;
                }
                $supply->status = false;
                $supply->save();
            }
        }
        $oldWarehouseStock->quantity = $oldWarehouseStock->quantity +  $kitchenrequest->quantity ;
        $oldWarehouseStock->save();
        $WarehouseStock = WarehouseStock::where('material_id',$validated['material_id'])->get()->first();
        $material = Material::find($validated['material_id']);
        $supplies = $material->supplies->where('status',false);
        $request_quantity = $validated['quantity'];
        $request_total_price=0 ;
        $supply_ids = [];
        if ($WarehouseStock->quantity >= $validated['quantity']) {
            foreach ($supplies as $supply) {
                $supply_remaining_amount = $supply->quantity - $supply->used_amount;
                $supply_unit_price = $supply->price / $supply->quantity;
                if ( $request_quantity  > 0) {
                    if ($supply_remaining_amount < $request_quantity) {
                        $request_quantity =  $request_quantity - $supply_remaining_amount;
                        $supply->used_amount = $supply->quantity;
                        $supply->status = true;
                        $request_total_price = $request_total_price + ( $supply_unit_price * $supply_remaining_amount);
                        $supply->save();
                    }elseif ( $supply_remaining_amount > $request_quantity ) {
                        $supply->used_amount = $supply->used_amount + $request_quantity;
                        $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                        $request_quantity = 0;
                        $supply->save();
                    }else {
                        $supply->used_amount = $supply->used_amount + $request_quantity;
                        $supply->status = true;
                        $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                        $request_quantity = 0;
                        $supply->save();
                    }
                    $supply_ids[]= $supply->id;
                }
            }
            $WarehouseStock->quantity =$WarehouseStock->quantity - $validated['quantity'] ;
            $WarehouseStock->save();
            $kitchenrequest->material_id = $validated['material_id'];
            $kitchenrequest->quantity = $validated['quantity'];
            $kitchenrequest->employee_id = $validated['employee_id'];
            $kitchenrequest->total_cost = $request_total_price;
            $kitchenrequest->save();
            $kitchenrequest->supplies()->sync($supply_ids);
            $request->session()->flash('message',__('kitchenrequests.massages.created_succesfully'));
            return redirect(route('kitchenrequests.index'));
        }else {
            $request->session()->flash('message',' الكمية المطلوبة أكبر من المخزون ');
            return redirect(route('kitchenrequests.create'));   
        }
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
        $WarehouseStock = WarehouseStock::where('material_id', $kitchenrequest->material_id)->get()->first();
        foreach ($kitchenrequest->supplies as  $supply) {
            if ( $kitchenrequest->quantity  != 0) {
                if ($supply->used_amount <= $kitchenrequest->quantity ) {
                    $supply->used_amount = 0;
                }else{
                    $supply->used_amount = $supply->used_amount - $kitchenrequest->quantity;
                }
                $supply->status = false;
                $supply->save();
            }
        }
        $WarehouseStock->quantity = $WarehouseStock->quantity +  $kitchenrequest->quantity ;
        $WarehouseStock->save();
        $kitchenrequest->delete();
        $request->session()->flash('message',__('kitchenrequests.massages.deleted_succesfully'));
        return redirect(route('kitchenrequests.index'));
    }
}
