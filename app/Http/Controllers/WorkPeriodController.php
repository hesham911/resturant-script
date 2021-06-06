<?php

namespace App\Http\Controllers;

use App\Bank;
use App\WorkPeriod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::getBankCashierNotInWork()->get();
<<<<<<< HEAD
        return view('admin.accounting.work-period.start-work',['banks'=>$banks]);
=======
        $userlog = Auth::user()->userLog();

        if ($userlog == true){
            $workPeriod= WorkPeriod::GetIdFromUser(Auth::id())->first()->id;

            return redirect(route('orders.create',['workPeriod'=>$workPeriod]));
        }else{
           // $banks = Bank::getBankCashierNotInWork()->get();
            return view('admin.accounting.work-period.start-work',['banks'=>$banks]);
        }

>>>>>>> 7612fef92bfa57ada1ac75b1c55badb25eaa364c
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $workPeriod= array(
            'user_id'           => Auth::id(),
            'bank_id'           => $request['bank'],
//            'opening_balance'   => $request['opening_balance'],
=======
        $request->validate([
            'bank'=>'required',
        ]);
        $workPeriod= array(
            'user_id'           => Auth::id(),
            'bank_id'           => $request['bank'],
//            'opening_balance' => $request['opening_balance'],
>>>>>>> 7612fef92bfa57ada1ac75b1c55badb25eaa364c
            'date_start'        => Carbon::now(),
            'status'            => 1,
        );

        $workPeriod = WorkPeriod::create($workPeriod);

<<<<<<< HEAD
        return route('orders.create',['workPeriod'=>$workPeriod]);
=======
        return redirect(route('orders.create',['workPeriod'=>$workPeriod]));
>>>>>>> 7612fef92bfa57ada1ac75b1c55badb25eaa364c
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkPeriod  $workPeriod
     * @return \Illuminate\Http\Response
     */
//    public function show(WorkPeriod $workperiod)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkPeriod  $workPeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkPeriod $workperiod)
    {

        $payments = WorkPeriod::getAllIncome($workperiod->id);
        $expenses = WorkPeriod::getAllOutCome($workperiod->id);
        $total    = WorkPeriod::GetCloseBalance($workperiod->id);

        return view('admin.accounting.work-period.end-work',[
            'payments'      => $payments,
            'expenses'      => $expenses,
            'total'         =>$total,
            'workperiod'    =>$workperiod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkPeriod  $workPeriod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkPeriod $workperiod)
    {
       $workperiod->update($request->all());
<<<<<<< HEAD
       return route('start.work.view');
=======
       return redirect(route('start.work.view'));
>>>>>>> 7612fef92bfa57ada1ac75b1c55badb25eaa364c
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkPeriod  $workPeriod
     * @return \Illuminate\Http\Response
     */
//    public function destroy(WorkPeriod $workperiod)
//    {
//        //
//    }
}
