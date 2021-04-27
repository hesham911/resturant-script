<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WarehouseStock;

class WarehouseStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = WarehouseStock::with('material')->get();
        return view('admin.warehousestock.index',['stocks'=>$stocks]);
    }

   
}
