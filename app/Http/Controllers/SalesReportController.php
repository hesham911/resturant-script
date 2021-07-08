<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;   
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;


class SalesReportController extends Controller
{
    public function index (){
        return view('admin.reports.sales.index');
    }

    public function indexData (Request $request){
        $from =  date('Y-m-d h:i:s',strtotime($request->from.' 00:00:00'));
        $to =  date('Y-m-d h:i:s',strtotime($request->to.' 00:00:00'));
        $material_id = $request->material ; 
        config()->set('database.connections.mysql.strict', false);
        if ($request->from != null & $request->to != null ) {
            $orders = Order::with('products')->where('status',3)->get()
                            ->groupBy(function($data){
                                return $data->created_at->format('d/m/y');
                            });
            return response()->json($orders);
        }

       return null;

    }
}
