<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\OrderRequest;
use App\User;
use App\Order;
use App\Product;
use App\Table;
use App\Subcategory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order::o
        $orders = Order::get();
        return view('admin.orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clients = Client::all();
        $subcategories = Subcategory::all();
        $tables = Table::all();
        $types = Order::type();
        $products = Product::all();
        return view('admin.orders.create',['clients'=>$clients,'subcategories'=>$subcategories,
            'tables'=>$tables,'types'=>$types,'products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();
        $order=Order::create($validated);
        $order->products()->attach($request->products);
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
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
