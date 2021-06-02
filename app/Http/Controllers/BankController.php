<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankTransaction;
use App\Http\Requests\BankRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::get();
        return view('admin.accounting.banks.index',['banks'=>$banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accounting.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {

        $validated = $request->validated();
        $bank = Bank::create($validated);
        if ($bank){
            BankTransaction::create([
                'bank_id'       =>  $bank->id,
                'user_id'       =>  Auth::id(),
                'notes'         =>  __('accounting.banks.massages.create_bank'),
                'amount'        =>  $validated['opening_balance'],
                'balance'       =>  $validated['opening_balance'],
            ]);
        }
        $request->session()->flash('message',__('accounting.banks.massages.created_successfully'));
        return redirect(route('banks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        $transCount = $bank->bankTransactions->count();

        return view('admin.accounting.banks.edit',['bank'=>$bank,'transCount' => $transCount]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, Bank $bank)
    {
        $validated = $request->validated();
       $updated=  $bank->update($validated);
       if ($updated && $bank->bankTransactions[0]->amount != $validated['opening_balance']){

           $transactions = $bank->bankTransactions;
           $transactions[0]->update([
               'amount' => $validated['opening_balance'],
               'balance' => $validated['opening_balance'],
           ]);
       }
        $request->session()->flash('message',__('accounting.banks.massages.updated_successfully'));
        return redirect(route('banks.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank,Request $request)
    {
        $bank->delete();
        $request->session()->flash('message',__('accounting.banks.massages.deleted_successfully'));
        return redirect(route('banks.index'));
    }
}
