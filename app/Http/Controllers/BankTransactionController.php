<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankTransaction;
use App\Http\Requests\BankTransactionRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankTrans = DB::table('bank_transactions')->get()->groupBy('created_at');
        foreach ($bankTrans as $key  =>  $bankTran){
            if ($bankTran->count() <= 1){
                $bankTrans->forget($key);
            }
        }

        return view('admin.accounting.transactions.index',['bankTrans'=>$bankTrans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banks = Bank::all();
        if ($banks->count() >= 2){
            return view('admin.accounting.transactions.create',['banks'=>$banks]);
        }else{
            $request->session()->flash('message',__('accounting.transactions.massages.less_banks'));
            return redirect()->back();
        }

    }


    public function store(BankTransactionRequest $request)
    {

        $validated = $request->validated();

        $fromBank   = Bank::FindOrFail($validated['fromBank']);
        $toBank     = Bank::FindOrFail($validated['toBank']);
        $amount     = (double) $validated['amount'];

        //dd(BankTransaction::sumBalance($amount,$fromBank->id),$amount);
        if ($fromBank && $toBank){
            DB::table('bank_transactions')->insert([
                [
                    'bank_id'       =>  $fromBank->id,
                    'user_id'       =>  Auth::id(),
                    'notes'         =>  $validated['notes'],
                    'amount'        =>  $amount,
                    'balance'       =>  BankTransaction::subBalance($amount,$fromBank->id),
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ],[
                    'bank_id'       =>  $toBank->id,
                    'user_id'       =>  Auth::id(),
                    'notes'         =>  $validated['notes'],
                    'amount'        =>  - $amount,
                    'balance'       =>  BankTransaction::sumBalance($amount,$toBank->id),
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]
            ]);
        }

        $request->session()->flash('message',__('accounting.banks.massages.created_successfully'));
        return redirect(route('transactions.index'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransaction $bankTransaction)
    {
        //
    }
}
