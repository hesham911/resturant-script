<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dailyIncome()
    {
        $payments = Payment::whereDate('created_at',Carbon::today())->with('workperiod.bank','user')->get();
        return view('admin.reports.daily.income',['payments'=>$payments]);

    }

    public function dailyOutcome()
    {

    }

    public function dailyIncomeData()
    {
        $x = Payment::whereDate('created_at',Carbon::today())->paginate(14);
        dd($x);
        return view('admin.reports.daily.income');

    }

    public function dailyOutcomeData()
    {

    }

    public function Income()
    {

    }

    public function Outcome()
    {

    }

    public function CostReport()
    {

    }

    public function supplyReport()
    {

    }
}
