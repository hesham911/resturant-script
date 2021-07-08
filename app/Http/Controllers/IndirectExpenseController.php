<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndirectExpenseRequest;
use App\IndirectCost;
use App\IndirectExpense;
use App\WorkPeriod;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndirectExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $IndirectExpenses = IndirectExpense::get();
        return view('admin.accounting.indirect-expenses.index',['IndirectExpenses'=>$IndirectExpenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $IndirectCosts = IndirectCost::get();
         $workPeriod= WorkPeriod::GetIdFromUser(Auth::id())->first()->id;
        return view('admin.accounting.indirect-expenses.create',['IndirectCosts'=>$IndirectCosts,'workPeriod'=>$workPeriod]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndirectExpenseRequest $request)
    {
       $validated = $request->validated();
       $dates = explode(' - ', $validated['daterangepicker']);
       $start = Carbon::parse($dates[0]);
       $end   = Carbon::parse($dates[1]);
       $cost= IndirectCost::FindOrFail($validated['costs']);
       IndirectExpense::create([
           'indirect_cost_id'   => $validated['costs'],
           'date_from'          => $start,
           'date_to'            => $end,
           'work_period_id'     => $request['work_period_id'],
           'amount'             => $validated['amount'],
       ]);

       $request->session()->flash('message',__('accounting.indirect-expenses.massages.created_successfully'));
       return redirect(route('indirect.expenses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IndirectExpense  $indirectExpense
     * @return \Illuminate\Http\Response
     */
    public function show(IndirectExpense $indirectExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IndirectExpense  $indirectExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(IndirectExpense $indirectExpense)
    {
        $IndirectCosts = IndirectCost::get();
        $start =  strtr(date("m-d-Y",strtotime($indirectExpense->date_from)),'-','/') ;
        $end   =  strtr(date("m-d-Y",strtotime($indirectExpense->date_to)),'-','/') ;

        return view('admin.accounting.indirect-expenses.edit',[
            'indirectExpense'=>$indirectExpense,
            'IndirectCosts'=>$IndirectCosts,
            'start'=>$start,
            'end'=>$end,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IndirectExpense  $indirectExpense
     * @return \Illuminate\Http\Response
     */
    public function update(IndirectExpenseRequest $request, IndirectExpense $indirectExpense)
    {

        $validated = $request->validated();

        $dates = explode(' - ', $validated['daterangepicker']);
        $start = Carbon::parse($dates[0]);
        $end   = Carbon::parse($dates[1]);
        $indirectExpense->update([
            'indirect_cost_id'   => $validated['costs'],
            'date_from'          => $start,
            'date_to'            => $end,
            'amount'             => $validated['amount'],
        ]);
        $request->session()->flash('message',__('accounting.indirect-expenses.massages.updated_successfully'));
        return redirect(route('indirect.expenses.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IndirectExpense  $indirectExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,IndirectExpense $indirectExpense)
    {
        $indirectExpense->delete();
        $request->session()->flash('message',__('accounting.indirect-expenses.massages.deleted_successfully'));
        return redirect(route('indirect.expenses.index'));
    }
}
