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
            $orders = DB::table('orders')->where('status',0)->join('order_product','orders.id', '=','order_product.order_id')->join('products' , 'order_product.product_id' , 'products.id')->select(DB::Raw('DATE(orders.created_at) day','select* from products'),'products.price')->groupBy('day')->get();
            // $orders;
            return response()->json($orders);
        }

       return null;

    }
}
