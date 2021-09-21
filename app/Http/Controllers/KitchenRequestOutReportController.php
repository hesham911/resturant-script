<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Material;
use Yajra\Datatables\Datatables;
use App\Supply;

class KitchenRequestOutReportController extends Controller
{
    public function index (){
        $materials = Material::get();
        return view('admin.reports.kitchenrequestout.index',['materials'=>$materials]);
    }

    public function indexData (Request $request){
        $materials = Material::with('measuring');
        $from =  date('Y-m-d h:i:s',strtotime($request->from.' 00:00:00'));
        $to =  date('Y-m-d h:i:s',strtotime($request->to.' 00:00:00'));
        $material_id = $request->material ; 

        if ($request->from != null & $request->to != null ) {
            $materials->with(['kitchenrequests'=>function ($query)use($from , $to){
                $query->whereBetween('created_at' , [$from , $to]);
            }]);
        }
        // else{
        //     $materials->with('supplies');
        // }

        if ($material_id) {
            $materials->whereIn('id', $material_id);
        }

        return Datatables::of($materials)->make(true);
    }
}
