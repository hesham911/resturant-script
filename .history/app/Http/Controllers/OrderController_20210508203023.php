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
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        /* $clients = Client::all(); */
        $categories = Category::all();
        $tables = Table::all();
        $types = Order::type();
        $products = Product::all();
        return view('admin.orders.create',['categories'=>$categories,
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
        $employee_id=Auth::user()-
        $order=Order::create($validated);
        $order->products()->attach($request->group_a);
        /* if($order)
        {
            //dd($request->group_a);
            $order->products()->createMany($request->group_a);
        } */
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
        $categories = Category::all();
        $tables = Table::all();
        $types = Order::type();
        $products = Product::all();
        return view('admin.orders.edit',['order'=>$order,'categories'=>$categories,
            'tables'=>$tables,'types'=>$types,'products'=>$products]);
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
        $order->update($validated);
        $order->products()->attach($request->group_a);
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
