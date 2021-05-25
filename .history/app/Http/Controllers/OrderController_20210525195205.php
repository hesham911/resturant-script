<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Table;
use App\Client;
use App\Payment;
use App\Product;
use App\Category;
use App\Subcategory;
use App\KitchenRequest;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->status == null)
        {
            $request->status=0;
        }
        $orders = Order::where('status',$request->status)->latest()->get();
        return view('admin.orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client=null;
        if($request->client)
        {
            $client = Client::findOrFail($request->client);
        }
        /* $clients = Client::all(); */
        $categories = Category::all();
        $tables = Table::all();
        $types = Order::type();
        $products = Product::all();
        return view('admin.orders.create',['categories'=>$categories,
            'tables'=>$tables,'types'=>$types,'products'=>$products,'client'=>$client]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        //$request->employee_id=Auth::user()->id;
        $validated = $request->validated();
        $order=Order::create($validated);
        $order->products()->sync($request->group_a);
        $requests = [];
        foreach ( $order->products as $product ) {
            for ($i=0; $i < $product->pivot->quantity ; $i++) {
                if ($product->ProductManufactures->count() > 0) {
                    foreach ($product->ProductManufactures as $ProductManufacture) {
                        $kitchenrequests = KitchenRequest::where('material_id',$ProductManufacture->material_id)->where('status',0)->get();
                        $productmanufacturequantity = $ProductManufacture->required_quantity + $ProductManufacture->waste_percentage;
                        if ($productmanufacturequantity > 0) {
                            if ($kitchenrequests->count() > 0) {
                                foreach ($kitchenrequests as $kitchenrequest) {
                                    $quantitydifference = $kitchenrequest->quantity - $kitchenrequest->used_amount;
                                    if ($productmanufacturequantity < $quantitydifference) {
                                        $kitchenrequest->used_amount = $kitchenrequest->used_amount + $productmanufacturequantity;
                                        $kitchenrequest->save();
                                        $productmanufacturequantity = 0 ;
                                        $requests[]=$kitchenrequest->id;
                                        break;
                                    }elseif ($productmanufacturequantity > $quantitydifference){
                                        $kitchenrequest->used_amount =  $kitchenrequest->quantity ;
                                        $kitchenrequest->status =  1;
                                        $kitchenrequest->save();
                                        $productmanufacturequantity =  $productmanufacturequantity-$quantitydifference ;
                                        $requests[]=$kitchenrequest->id;
                                    }else {
                                        $kitchenrequest->used_amount = $kitchenrequest->used_amount + $ProductManufacture->required_quantity;
                                        $kitchenrequest->status =  1;
                                        $kitchenrequest->save();
                                        $productmanufacturequantity = 0 ;
                                        $requests[]=$kitchenrequest->id;
                                        break;
                                    }
                                }
                            }else {
                                $request->session()->flash('message',__('orders.massages.material_doesnt_exist'));
                                return redirect(route('orders.create'));
                            }
                        }
                    }
                }else {
                    $request->session()->flash('message',__('orders.massages.please_enter_productmanufacture'));
                    return redirect(route('orders.create'));
                }
            }
        }
        /* if($order)
        {
            //dd($request->group_a);
            $order->products()->createMany($request->group_a);
        } */
        $order->requests()->sync($requests);
        $request->session()->flash('message',__('orders.massages.created_successfully'));
        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.view',['order'=>$order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function status(Order $order,$state,Request $request)
    {
        $order->update(['status'=>$state]);
        if($state == 3)
        {
            $payment = new Payment();
            $payment->employee_id = Auth::user()->id;
            $payment->total_price = $order->total_price;
            $order->payment()->save($payment);
        }
        $request->session()->flash('message',__('orders.massages.change_status'));
        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function cancel(Order $order,Request $request)
    {
        foreach ( $order->products as $product ) {
            for ($i=0; $i < $product->pivot->quantity ; $i++) {
                if ($product->ProductManufactures->count() > 0) {
                    foreach ($product->ProductManufactures as $ProductManufacture) {
                        $kitchenrequests = $order->requests->where('material_id',$ProductManufacture->material_id)->first();
                        $productmanufacturequantity = $ProductManufacture->required_quantity;
                        if ($productmanufacturequantity > 0) {
                            foreach ($kitchenrequests as $kitchenrequest) {
                                $kitchenrequest->used_amount =  $kitchenrequest->used_amount -  $productmanufacturequantity;
                                $kitchenrequest->status =0 ;
                                $kitchenrequest->save();
                            }
                        }
                    }
                }
            }
        }
        $order->status=4;
        $order->cancel_reason=$request->cancel_reason;
        $order->save();
        $request->session()->flash('message',__('orders.massages.cancel_successfully'));
        return redirect(route('orders.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $client=null;
        if($order->client)
        {
            $client = Client::findOrFail($request->client);
        }
        $categories = Category::all();
        $tables = Table::all();
        $types = Order::type();
        $products = Product::all();
        $ordProducts=$order->products;
        return view('admin.orders.edit',['order'=>$order,'categories'=>$categories,
            'tables'=>$tables,'types'=>$types,'products'=>$products,
            'ordProducts'=>$ordProducts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $validated = $request->validated();
        dd($validated);
        foreach ( $order->products as $product ) {
            for ($i=0; $i < $product->pivot->quantity ; $i++) {
                if ($product->ProductManufactures->count() > 0) {
                    foreach ($product->ProductManufactures as $ProductManufacture) {
                        $kitchenrequests = $order->requests->where('material_id',$ProductManufacture->material_id);
                        $productmanufacturequantity = $ProductManufacture->required_quantity;
                        if ($productmanufacturequantity > 0) {
                            foreach ($kitchenrequests as $kitchenrequest) {
                                $kitchenrequest->used_amount =  $kitchenrequest->used_amount -  $productmanufacturequantity;
                                $kitchenrequest->status =0 ;
                                $kitchenrequest->save();
                            }
                        }
                    }
                }
            }
        }
        $order->update($validated);
        $order->products()->sync($request->group_a);
        $requests = [];
        foreach ( $order->products as $product ) {
            for ($i=0; $i < $product->pivot->quantity ; $i++) {
                if ($product->ProductManufactures->count() > 0) {
                    foreach ($product->ProductManufactures as $ProductManufacture) {
                        $kitchenrequests = KitchenRequest::where('material_id',$ProductManufacture->material_id)->where('status',0)->get();
                        $productmanufacturequantity = $ProductManufacture->required_quantity;
                        if ($productmanufacturequantity > 0) {
                            if ($kitchenrequests->count() > 0) {
                                foreach ($kitchenrequests as $kitchenrequest) {
                                    $quantitydifference = $kitchenrequest->quantity - $kitchenrequest->used_amount;
                                    if ($productmanufacturequantity < $quantitydifference) {
                                        $kitchenrequest->used_amount = $kitchenrequest->used_amount + $productmanufacturequantity;
                                        $kitchenrequest->save();
                                        $productmanufacturequantity = 0 ;
                                        $requests[]=$kitchenrequest->id;
                                        break;
                                    }elseif ($productmanufacturequantity > $quantitydifference){
                                        $kitchenrequest->used_amount =  $kitchenrequest->quantity ;
                                        $kitchenrequest->status =  1;
                                        $kitchenrequest->save();
                                        $productmanufacturequantity =  $productmanufacturequantity-$quantitydifference ;
                                        $requests[]=$kitchenrequest->id;
                                    }else {
                                        $kitchenrequest->used_amount = $kitchenrequest->used_amount + $ProductManufacture->required_quantity;
                                        $kitchenrequest->status =  1;
                                        $kitchenrequest->save();
                                        $productmanufacturequantity = 0 ;
                                        $requests[]=$kitchenrequest->id;
                                        break;
                                    }
                                }
                            }else {
                                $request->session()->flash('message',__('orders.massages.material_doesnt_exist'));
                                return redirect(route('orders.create'));
                            }
                        }
                    }
                }else {
                    $request->session()->flash('message',__('orders.massages.please_enter_productmanufacture'));
                    return redirect(route('orders.create'));
                }
            }
        }
        $order->requests()->sync($requests);
        $request->session()->flash('message',__('orders.massages.updated_successfully'));
        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
