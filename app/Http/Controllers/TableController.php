<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::get();
        return view('table.index',['tables'=>$tables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest  $request)
    {
        $validated = $request->validated();
        Table::create($validated);
        $request->session()->flash('message',__('tables.notifications.created_succesfully'));
        return redirect(route('table.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        return view('table.show',['table',$table]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        return view('table.edit',['table',$table]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(TableRequest $request, Table $table)
    {
        $validated = $request->validated();
        $table->name = $validated->name;
        $table->floor_id = $validated->floor_id;
        $table->save();
        $request->session()->flash('message',__('tables.notifications.created_succesfully'));
        return redirect(route('table.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        $request->session()->flash('message',__('tables.notifications.deleted_succesfully'));
        return redirect(route('table.index'));
    }
}
