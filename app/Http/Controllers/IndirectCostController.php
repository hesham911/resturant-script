<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndirectCostRequest;
use App\IndirectCost;
use Illuminate\Http\Request;

class IndirectCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IndirectCosts = IndirectCost::get();
        return view('admin.accounting.indirect-costs.index',['IndirectCosts'=>$IndirectCosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accounting.indirect-costs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndirectCostRequest $request)
    {

        $validated = $request->validated();
        IndirectCost::create($validated);
        $request->session()->flash('message',__('accounting.indirect-costs.massages.created_successfully'));
        return redirect(route('indirect.costs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IndirectCost  $indirectCost
     * @return \Illuminate\Http\Response
     */
    public function show(IndirectCost $indirectCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IndirectCost  $indirectCost
     * @return \Illuminate\Http\Response
     */
    public function edit(IndirectCost $indirectCost)
    {

        return view('admin.accounting.indirect-costs.edit',['indirectCost'=>$indirectCost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IndirectCost  $indirectCost
     * @return \Illuminate\Http\Response
     */
    public function update(IndirectCostRequest $request, IndirectCost $indirectCost)
    {
        $validated = $request->validated();
        $indirectCost->update($validated);
        $request->session()->flash('message',__('accounting.indirect-costs.massages.updated_successfully'));
        return redirect(route('indirect.costs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IndirectCost  $indirectCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndirectCost $indirectCost,Request $request)
    {
        $indirectCost->delete();
        $request->session()->flash('message',__('accounting.indirect-costs.massages.deleted_successfully'));
        return redirect(route('indirect.costs.index'));
    }
}
