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
        $kitchenrequests = KitchenRequest::with('user','material')->get();
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
        $this->checkForEnoughSupplies($validated_data['group']);
        foreach ($validated_data['group'] as  $kitchen_request) {
            $supplies = Material::find($kitchen_request['material_id'])->supplies->where('status',false);
            $WarehouseStock = WarehouseStock::where('material_id',$kitchen_request['material_id'])->get()->first();
            if ($WarehouseStock->quantity >= $kitchen_request['quantity']) {
                $this->subtractQuantityCalcultePrice ($supplies , $WarehouseStock , $kitchen_request);
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
        $material_id = $request->material_id;
        $quantity = $request->quantity;
        $user_id = $request->user_id;
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
        $WarehouseStock = WarehouseStock::where('material_id',$material_id)->get()->first();
        $material = Material::find($material_id);
        $supplies = $material->supplies->where('status',false);
        $request_quantity = $request->quantity;
        $request_total_price=0 ;
        $supply_ids = [];

        if ($supplies->sum('quantity')-$supplies->sum('used_amount') < $request_quantity) {
            $request->session()->flash('message',' الكمية المطلوبة أكبر من المخزون ');
            return redirect(route('kitchenrequests.create')); 
        }
        if ($WarehouseStock->quantity >= $request->quantity) {
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
                        $supply_ids[]= ['supply_id'=>$supply->id , 'quantity'=> $supply_remaining_amount];
                    }elseif ( $supply_remaining_amount > $request_quantity ) {
                        $supply->used_amount = $supply->used_amount + $request_quantity;
                        $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                        $supply->save();
                        $supply_ids[]= ['supply_id'=>$supply->id , 'quantity'=> $request_quantity];
                        $request_quantity = 0;
                    }else {
                        $supply->used_amount = $supply->used_amount + $request_quantity;
                        $supply->status = true;
                        $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                        $supply->save();
                        $supply_ids[]= ['supply_id'=>$supply->id , 'quantity'=> $request_quantity];
                        $request_quantity = 0;
                    }
                }
            }
            $WarehouseStock->quantity =$WarehouseStock->quantity - $request->quantity ;
            $WarehouseStock->save();
            $kitchenrequest->material_id = $material_id;
            $kitchenrequest->quantity = $request->quantity;
            $kitchenrequest->user_id = $user_id;
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

    private function checkForEnoughSupplies($array){
        foreach ($array as  $kitchen_request) {
            $material = Material::find($kitchen_request['material_id']);
            $supplies = $material->supplies->where('status',false);
            if ($supplies->sum('quantity')-$supplies->sum('used_amount') < $kitchen_request['quantity'] ) {
                $request->session()->flash('message',' الكمية المطلوبة أكبر من المخزون ');
                return redirect(route('kitchenrequests.create')); 
            }
        }
    }

    private function storeKitchenRequest($item , $total){
        $kitchenrequest = new KitchenRequest;
        $kitchenrequest->material_id = $item['material_id'];
        $kitchenrequest->quantity = $item['quantity'];
        $kitchenrequest->user_id = Auth::user()->id;
        $kitchenrequest->total_cost = $total;
        $kitchenrequest->save();
        return $kitchenrequest;
    }

    private function subtractQuantityCalcultePrice ($supplies , $WarehouseStock , $kitchen_request){
        $request_total_price=0 ;
        $request_quantity = $kitchen_request['quantity'];
        $supply_ids = [];
        foreach ($supplies as $supply) {
            $supply_remaining_amount = $supply->quantity - $supply->used_amount;
            $supply_unit_price = $supply->price / $supply->quantity;
            if ( $request_quantity  > 0) {
                if ($supply_remaining_amount < $request_quantity) {
                    $request_quantity =  $request_quantity - $supply_remaining_amount;
                    $request_total_price = $request_total_price + ( $supply_unit_price * $supply_remaining_amount);
                    $this->updateSupply(1 , $supply->quantity , $supply );
                    $supply_ids[]= ['supply_id'=>$supply->id , 'quantity'=> $supply_remaining_amount];

                }elseif ( $supply_remaining_amount > $request_quantity ) {
                    $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                    $this->updateSupply( 0 , $supply->used_amount + $request_quantity , $supply);
                    $supply_ids[]= ['supply_id'=>$supply->id , 'quantity'=> $request_quantity];
                    $request_quantity = 0;
                }else {
                    $request_total_price = $request_total_price + ( $supply_unit_price * $request_quantity);
                    $this->updateSupply( 1 , $supply->used_amount + $request_quantity , $supply);
                    $supply_ids[]= ['supply_id'=>$supply->id , 'quantity'=> $request_quantity];
                    $request_quantity = 0;
                }
                
            }
        }
        $WarehouseStock->update(['quantity' => $WarehouseStock->quantity - $kitchen_request['quantity']]);
        $kitchenrequest = $this->storeKitchenRequest($kitchen_request , $request_total_price);
        $kitchenrequest->supplies()->sync($supply_ids);
    }

    private function updateSupply ($status , $amount , $supply){
        $supply->update([
            'status' =>  true,
            'used_amount' =>  $amount,
        ]);
    }
}
