<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Material;
use Yajra\Datatables\Datatables;
use App\Supply;

class WarehouseReportController extends Controller
{
    public function index (){
        $materials = Material::get();
        return view('admin.reports.warehouse.index',['materials'=>$materials]);
    }
    public function indexData (Request $request){
        $materials = Material::with('supplies','measuring');
        $to = $request->to;
        $from = $request->from;

        if ($to or $from) {
            // dd($from);
            $materials->whereHas('supplies',function($query)use($to , $from){
                $query->whereBetween('supplies.created_at',[$from , $to]);
            });
        }
        return Datatables::of($materials)->make(true);

    }
}
