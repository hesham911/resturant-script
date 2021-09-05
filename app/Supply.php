<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'quantity',
        'price',
        'Supplier_name',
        'expiry_date',
        'user_id',
        'material_id',
        'bill_number',
        'used_amount',
        'status',
    ];

    public function material (){
        return $this->belongsTo(Material::class)->withTrashed();
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function employee (){
        return $this->belongsTo(Employee::class);
    }

    public function kitchen_requests(){
        return $this->belongsToMany(KitchenRequest::class, 'request_supply'  , 'supply_id' ,'request_id')->withPivot('quantity');
    }

    public function SyncSupply ($kitchen_request ,$supply_ids){
        $kitchenrequest->supplies()->sync($supply_ids);
    }

    public static function calculation ($material_id , $quantity){
        // dd($request);    
        $material = Material::find($material_id);
        $supplies = $material->supplies->where('status',false);
        $request_quantity = $quantity;
        $WarehouseStock = WarehouseStock::where('material_id',$material_id)->get()->first();
        $request_total_price=0 ;
        $supply_ids = [];
        if ($WarehouseStock ) {
            if ($WarehouseStock->quantity >= $quantity  ) {
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
                $WarehouseStock->quantity =$WarehouseStock->quantity - $quantity ;
                $WarehouseStock->save();
                $status = 'success';
            }else {
                $status = 'insufficient_kitchen_request';
            }
        }else {
            $status = 'null_kitchen_request';
        }
        return [
            'supply_ids'=>$supply_ids ,
            'request_total_price' =>$request_total_price ,
            'status'=> $status
        ];
    }
}
