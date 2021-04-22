<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::get();
        return view('admin.geo.zones.index',['zones'=>$zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.geo.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        $validated = $request->validated();
        Zone::create($validated);
        $request->session()->flash('message',__('geo.zones.massages.created_successfully'));
        return redirect(route('zones.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
